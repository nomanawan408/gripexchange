<?php

namespace App\Http\Controllers;

use App\Events\DepositCreated;
use App\Models\AccountStatement;
use App\Models\Deposit;
use App\Models\PaymentMethod;
use App\Models\Referral;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    //
    public function index(){
        // get all payment methods
        $paymentMethods = PaymentMethod::all();
        return view('dashboard.deposit.index', compact('paymentMethods'));
    }

    public function showAccountDetails($slug)
    {
        $paymentMethod = PaymentMethod::where('slug', $slug)->firstOrFail();
        return view('dashboard.deposit.accountdetails', compact('paymentMethod'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'customer_transaction_id' => 'required|string|max:255',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'receipt' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'description' => 'nullable|string',
            'transaction_datetime' => 'required|date',
        ]);
    
        DB::transaction(function () use ($request) {
            $data = $request->only([
                'amount',
                'customer_transaction_id',
                'payment_method_id',
                'description',
                'transaction_datetime'
            ]);
    
            $data['user_id'] = Auth::id();
    
            $imageName = null;
            if ($request->hasFile('receipt')) {
                $imageName = time() .'-'. $request->customer_transaction_id . '.' . $request->receipt->extension();
                $request->receipt->move(public_path('receipt'), $imageName);
                $data['receipt_path'] = $imageName;
            }
    
            $deposit = Deposit::create($data);

            event(new DepositCreated($deposit)); // Emit event when deposit is requested         

                AccountStatement::create([
                'user_id' => $deposit->user_id,
                'payment_method_id' => $deposit->payment_method_id,
                'deposit_id' => $deposit->id,
                'amount' => $deposit->amount,
                'customer_transaction_id' => $deposit->customer_transaction_id,
                'receipt_path' => $deposit->receipt_path,
                'description' => $deposit->description,
                'transaction_datetime' => $deposit->transaction_datetime,
                'status' => Auth::user()->is_admin ? 'approved' : 'pending',
                'type' => 'Desposit via ' . $deposit->paymentMethod->title
            ]);    
            // Get the current user
            $user = Auth::user();
            
            // Give commission on every deposit
            $this->giveReferralCommission($user, $deposit);
        });

        return redirect()->route('account-statements.index')->with('success', '🎉 Great! Your payment has been submitted for verification. Our team will review and process it within 30 minutes. Your account will be updated once the payment is confirmed. Thank you for your patience! 💰');
    }

    protected function giveReferralCommission(User $user, Deposit $deposit)
    {
        // Check if the user was referred
        $referral = Referral::where('referred_id', $user->id)->first();
    
        if ($referral) {
            // Get referral commission percentage from the centralized settings table
            $referralPercentageSetting = Setting::where('key', 'referal_profit_percentage')->first();
            $referralPercentage = $referralPercentageSetting ? $referralPercentageSetting->value : 1.00; // Default to 1.00% if not set
    
            // Get referrer's wallet
            $referrerWallet = Wallet::where('user_id', $referral->referrer_id)
                                    ->where('currency', 'PKR')
                                    ->first();
            
            if ($referrerWallet) {
                // Calculate commission based on the percentage retrieved from settings
                $commission = $deposit->amount * ($referralPercentage / 100);
    
                // Update the referrer's wallet
                $referrerWallet->balance += $commission;
                $referrerWallet->referal_profit = $commission;
                $referrerWallet->total_profit += $commission;
                $referrerWallet->save();

                // Create account statement for the referral commission
                AccountStatement::create([
                    'user_id' => $referral->referrer_id,
                    'payment_method_id' => $deposit->payment_method_id,
                    'deposit_id' => $deposit->id,
                    'amount' => $commission,
                    'customer_transaction_id' => $deposit->customer_transaction_id . '-referral',
                    'description' => 'Referral Commission from ' . $user->name . '\'s deposit',
                    'transaction_datetime' => now(),
                    'type' => 'referral_commission',
                    'status' => 'approved',
                    'type' => 'Referral Commission from ' . $user->name . '\'s deposit'
                ]);
            }
        }    
    }
}