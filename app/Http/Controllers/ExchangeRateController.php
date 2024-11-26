<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    
    //
    public function index(){
        // get all the payment method
        $exchangeRates = ExchangeRate::with('paymentMethod')->get();
        
        return view('dashboard.exchangerate.index', compact('exchangeRates')); 
    }

    public function edit($id)
    {
        $exchangeRate = ExchangeRate::findOrFail($id);
        $paymentMethods = PaymentMethod::all();
        return view('dashboard.exchangerate.edit', compact('exchangeRate', 'paymentMethods'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'payment_method_id' => 'required|exists:payment_methods,id',
            'buy' => 'required|numeric',
            'sell' => 'required|numeric',
            'deposit_fee' => 'required|numeric',
            'withdraw_fee' => 'required|numeric',
            'deposit_fee_type' => 'required|in:fixed,percentage',
            'withdraw_fee_type' => 'required|in:fixed,percentage',
        ]);

        $exchangeRate = ExchangeRate::findOrFail($id);
        $exchangeRate->update($request->all());

        return redirect()->route('exchange.index')->with('success', 'Exchange rate updated successfully.');
    }
    public function getRate(PaymentMethod $paymentMethod)
    {
        try {
            $exchangeRate = $paymentMethod->exchangeRate;
    
            if (!$exchangeRate) {
                return response()->json(['error' => 'Exchange rate not found'], 404);
            }
    
            return response()->json([
                'buy_rate' => $exchangeRate->buy,
                'sell_rate' => $exchangeRate->sell,
                'deposit_fee' => $exchangeRate->deposit_fee,
                'withdraw_fee' => $exchangeRate->withdraw_fee,
            ]);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Failed to fetch exchange rate: ' . $e->getMessage());
    
            return response()->json(['error' => 'Failed to fetch exchange rate'], 500);
        }
    }    
    
}
