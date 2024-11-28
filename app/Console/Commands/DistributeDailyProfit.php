<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Setting;
use App\Models\AccountStatement;
use App\Models\Deposit;
use App\Models\Referral;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DistributeDailyProfit extends Command
{
    protected $signature = 'profit:distribute';
    protected $description = 'Distribute daily profit to users based on their deposits';

    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        // Fetch the daily profit percentage from settings
        $dailyProfitPercentageSetting = Setting::where('key', 'daily_profit_percentage')->first();
        $dailyProfitPercentage = $dailyProfitPercentageSetting ? $dailyProfitPercentageSetting->value : 1.00; // Default to 1.00% if not set
    
        // Get all users with deposits
        $usersWithDeposits = User::whereHas('wallets', function ($query) {
            $query->where('balance', '>', 0); // Ensure they have a balance
        })->get();
    
        foreach ($usersWithDeposits as $user) {
            // Get user's wallet (assuming each user has one wallet per currency)
            $wallet = $user->wallets()->where('currency', 'PKR')->first();
    
            if ($wallet) {
                // Calculate daily profit based on wallet balance
                $dailyProfit = $wallet->balance * ($dailyProfitPercentage / 100);
    
                // Add daily profit to the user's wallet
                $wallet->balance += $dailyProfit;
                $wallet->daily_profit = $dailyProfit; // Assuming you have a 'daily_profit' column
                $wallet->total_profit += $dailyProfit;
                $wallet->save();
                
                // Generate transaction ID for daily profit
                $transactionId = 'MNA_' . Str::random(8);
                
                
                // Create account statement entry for the user (User B)
                AccountStatement::create([
                    'user_id' => $user->id,
                    'payment_method_id' => null,
                    'amount' => $dailyProfit,
                    'description' => 'Daily Profit Deposit',
                    'customer_transaction_id' => $transactionId,
                    'status' => 'approved',
                    'type' => 'Daily profit', // Specify that this is a daily profit
                ]);

                // Check if the user has a referrer in the referrals table
                $referral = Referral::where('referred_id', $user->id)->first();
    
                if ($referral) {
                    // Get the referrer's details (User A) from the referral table
                    $referrer = $referral->referrer; // User A from 'referrer_id'
    
                    // Get the referrer's wallet
                    $referrerWallet = $referrer->wallets()->where('currency', 'PKR')->first();
    
                    if ($referrerWallet) {
                        // Calculate 10% of the referred user's (User B's) daily profit for the referrer (User A)
                        $referrerReferralProfit = $dailyProfit * 0.10;
    
                        // Add the referral profit to the referrer's wallet
                        $referrerWallet->balance += $referrerReferralProfit;
                        $referrerWallet->total_profit += $referrerReferralProfit;
                        $referrerWallet->save();
                        
                        // Generate transaction ID for daily profit
                        $transactionId = 'MNA_' . Str::random(8);

                        // Create account statement for the referrer (User A)
                        AccountStatement::create([
                            'user_id' => $referrer->id, // User A
                            'payment_method_id' => null,
                            'amount' => $referrerReferralProfit,
                            'description' => 'Referral Daily Profit',
                            'customer_transaction_id' => $transactionId,
                            'status' => 'approved',
                            'type' => 'Referral daily profit', // Specify that this is a referral profit
                        ]);
    
                        // Mark the referral as rewarded to avoid multiple rewards
                        $referral->rewarded = true;
                        $referral->save();
                    }
                }
            }
        }
    
        $this->info('Daily profit and referral profits distributed successfully.');
    }

}
