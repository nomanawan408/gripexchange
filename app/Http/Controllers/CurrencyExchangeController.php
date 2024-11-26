<?php

namespace App\Http\Controllers;

use App\Models\CurrencyExchange;
use App\Models\ExchangeRate;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CurrencyExchangeController extends Controller
{
    //
    public function index(){
        $paymentMethods = PaymentMethod::all();
        return view('dashboard.converter.index', compact('paymentMethods')); 
    }

    public function exchange(Request $request)
    {
        $request->validate([
            'from_payment_method_id' => 'required|exists:payment_methods,id',
            'to_payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $fromMethodId = $request->from_payment_method_id;
        $toMethodId = $request->to_payment_method_id;
        $amount = $request->amount;

        $to_method = PaymentMethod::where('id', $toMethodId)->firstOrFail();
        $from_method = PaymentMethod::where('id', $fromMethodId)->firstOrFail();
        
        // Step 1: Convert the amount from the source payment method to PKR
        $fromRate = ExchangeRate::where('payment_method_id', $fromMethodId)->firstOrFail()->sell;
        $amountInPKR = $amount * $fromRate; // Amount in PKR

        // Step 2: Convert the PKR amount to the target payment method
        $toRate = ExchangeRate::where('payment_method_id', $toMethodId)->firstOrFail()->buy;
        $convertedAmount = $amountInPKR * $toRate; // Amount in target currency

        // Apply the conversion fee (1%)
        $fee = $convertedAmount * 0.01;
        $finalAmount = $convertedAmount - $fee;

        

        // get user wallet
        $fromWallet = $user->wallets->firstOrFail();
        if (!$fromWallet || $fromWallet->balance < $amount) {
            return redirect()->back()->with('error', 'Insufficient balance. Please add funds to your wallet.');
        }
        $fromWallet->balance -= $amount;
        $fromWallet->save();

        // Add the converted amount to the user's 'to' wallet
        $toWallet = $user->wallets()->firstOrNew(
            ['user_id' => $user->id],
            ['balance' => 0]
        );
        $toWallet->save();
        $toWallet->balance += $finalAmount;
        $toWallet->save();

        DB::transaction(function () use ($user, $fromMethodId, $toMethodId, $amount, $finalAmount, $fromRate, $toRate, $fee) {
            
            // Record the conversion transaction
            CurrencyExchange::create([
                'user_id' => $user->id,
                'from_payment_method_id' => $fromMethodId,
                'to_payment_method_id' => $toMethodId,
                'amount' => $amount,
                'converted_amount' => $finalAmount,
                'exchange_rate' => $fromRate * $toRate, // Combined rate for tracking
                'fee' => $fee,
                'fee_type' => 'percentage',
                'status' => 'completed',
            ]);
            
        });
        return redirect()->route('currency-exchange.index')->with('success', 'Conversion successful. You have received ' . $finalAmount . ' in '.$to_method->title .' after fees(1%).');

    }
}
