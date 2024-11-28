<?php

namespace App\Http\Controllers;

use App\Events\WithdrawalRequested;
use App\Models\AccountStatement;
use App\Models\PaymentMethod;
use App\Models\Wallet;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WithdrawController extends Controller
{
    //
    public function index(){
        $paymentMethods = PaymentMethod::all();
        return view('dashboard.withdraw.index', compact('paymentMethods'));
        
    }

    public function showAccountDetails($slug)
    {
        $paymentMethod = PaymentMethod::where('slug', $slug)->firstOrFail();
        return view('dashboard.withdraw.withdraw_form', compact('paymentMethod'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            // 'customer_account_name' => 'required|string|max:255',
            'customer_account_number' => 'required|string|max:255',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'receipt' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'description' => 'nullable|string',
        ]);


        $wallet = Wallet::where('user_id', Auth::id())->where('currency', $request->currency)->firstOrFail();
        if ($wallet->balance < $request->amount) {
            return redirect()->route('withdraw.index')->with('error', 'Insufficient balance, Please Deposit first.!');
        }


        DB::transaction(function () use ($request) {
            $data = $request->only([
                'amount',
                'currency',
                'customer_account_name',
                'customer_account_number',
                'payment_method_id',
                'description'
            ]);

            $data['user_id'] = Auth::id();
            $data['customer_transaction_id'] = 'MNA_'.Str::random(8); // Generate a short random string for the transaction ID

            if ($request->hasFile('receipt')) {
                $data['receipt_path'] = $request->file('receipt')->store('receipts', 'public');
            }

            $withdrawal = Withdraw::create($data);

            // Trigger the withdrawal event
            event(new WithdrawalRequested($withdrawal)); // Assuming you have a WithdrawalCreated event

            // Create an account statement entry

            AccountStatement::create([
                'user_id' => $withdrawal->user_id,
                'payment_method_id' => $withdrawal->payment_method_id,
                'withdraw_id' => $withdrawal->id,
                'amount' => $withdrawal->amount,
                'currency' => $withdrawal->currency,
                // 'customer_account_name' => $withdrawal->customer_account_name,
                // 'customer_account_number' => $withdrawal->customer_account_number,
                'customer_transaction_id' => $withdrawal->customer_transaction_id,
                'receipt_path' => $withdrawal->receipt_path,
                'description' => $withdrawal->description,
                'type' => 'Withdrawal via ' . $withdrawal->paymentMethod->title,
            ]);

            // Update wallet balance
            $wallet = Wallet::where('user_id', $withdrawal->user_id)
                            ->where('currency', $withdrawal->currency)
                            ->firstOrFail();

            

            $wallet->balance -= $withdrawal->amount;
            $wallet->save();
        });

        return redirect()->route('account-statements.index')->with('success', '🎉 Great! Your payment has been submitted for verification. Our team will review and process it within 30 minutes. Your account will be updated once the payment is confirmed. Thank you for your patience! 💰');

    }
}