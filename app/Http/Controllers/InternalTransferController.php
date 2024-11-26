<?php

namespace App\Http\Controllers;

use App\Events\InternalTransfers;
use App\Models\InternalTransfer;
use App\Models\AccountStatement;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InternalTransferController extends Controller
{
    //
    public function index(){
        return view('dashboard.internaltransfer.index'); 
    }

    public function transfer(Request $request)
    {
        // Validate the request
        $request->validate([
            'receiver_email' => 'required|email|exists:users,email',
            'currency' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'transaction_pin' => 'required|string',
        ]);

        $sender = Auth::user();
        $wallet = $sender->wallet;

        // Check if the wallet exists and has a pin
        if (!$wallet || !isset($wallet->pin)) {
            return redirect()->back()->withErrors(['transaction_pin' => 'No wallet or PIN found for the user.']);
        }

        // Verify the transaction PIN
        if (!Hash::check($request->transaction_pin, $wallet->pin)) {
            return redirect()->back()->withErrors(['transaction_pin' => 'The transaction PIN is incorrect.']);
        }

        // Find the receiver by email
        $receiver = User::where('email', $request->receiver_email)->first();

        // Check if the sender has enough balance
        $senderWallet = $sender->wallets()->where('currency', $request->currency)->firstOrFail();

        if ($senderWallet->balance < $request->amount) {
            return redirect()->back()->withErrors(['amount' => 'Insufficient balance.']);
        }

        DB::transaction(function () use ($sender, $receiver, $senderWallet, $request) {
            // Deduct the amount from the sender's wallet
            $amt = $request->amount;

            $fee = $amt * 0.01;
            $finalAmount = $amt + $fee;
    
            $senderWallet->balance -= $finalAmount;
            $senderWallet->save();

            // Trigger the Internal Transfer Event
            event(new InternalTransfers($senderWallet));

            // Add the amount to the receiver's wallet
            $receiverWallet = $receiver->wallets()->firstOrCreate(
                ['currency' => $request->currency],
                ['balance' => 0]
            );
            $receiverWallet->balance += $amt;
            $receiverWallet->save();

            
            $transection_id = substr(Str::uuid(), 0, 12);

            // Trigger the Internal Transfer Event for the receiver
            event(new InternalTransfers($receiverWallet));
            
            $paymentMethod = PaymentMethod::where('slug', 'internal-transfer')->first();
            $paymentMethodId = $paymentMethod->id;

            $internal = InternalTransfer::create([
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'payment_method_id' => $paymentMethodId,
                'amount' => $finalAmount,
                'description' => $request->description,
                'currency' => $request->currency,
                'status' => 'success',
                'transaction_id' => $transection_id,
            ]);


            AccountStatement::create([
                'user_id' => $sender->id,
                'payment_method_id' => $paymentMethodId,
                'internal_transfer_id' => $internal->id,
                'amount' => $finalAmount,
                'currency' => $request->currency,
                'customer_account_name' =>  $receiver->name,
                'customer_account_number' => $receiver->email,
                'customer_transaction_id' => $transection_id,
                'receipt_path' => null,
                'description' => $paymentMethod->title,
            ]);
        });

        return redirect()->route('dashboard.index')->with('success', 'Amount successfully transferred to '.$receiver->name.'.');
    }
}
