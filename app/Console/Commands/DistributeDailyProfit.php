<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Setting;
use App\Models\AccountStatement;

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
            // Get user's wallet
            $wallet = $user->wallets()->where('currency', 'PKR')->first();

            if ($wallet) {
                // Calculate daily profit based on wallet balance
                $dailyProfit = $wallet->balance * ($dailyProfitPercentage / 100);

                // Add daily profit to the wallet
                $wallet->balance += $dailyProfit;
                $wallet->daily_profit = $dailyProfit; // Assuming you have a 'daily_profit' column
                $wallet->total_profit += $dailyProfit;
                $wallet->save();

                // Create account statement entry
                AccountStatement::create([
                    'user_id' => $user->id,
                    'payment_method_id' => null,
                    'amount' => $dailyProfit,
                    'description' => 'Daily Profit Deposit',
                    'status' => 'approved',
                ]);
            }
        }

        $this->info('Daily profit distributed successfully.');
    }
}
