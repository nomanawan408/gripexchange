<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;   
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\AccountStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        
        // Get total balance of all users if current user is superadmin
        $user = Auth::user();
        $totalBalance = 0;
        $wallet = $user->wallet;
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        if ($user->hasRole('admin')) {

            $totalBalance = Wallet::sum('balance');
            $totalDeposits = Deposit::sum('amount');
            $totalWidthdraw = Withdraw::sum('amount');
            $daily_profit = Wallet::sum('daily_profit');
            $total_profit = Wallet::sum('total_profit');

            $recentTransections = AccountStatement::with('paymentMethod', 'user')->latest()->take(5)->get(); // Fetch recent account statements with related data

        }else{
            $totalDeposits = $wallet->deposits()->orderBy('created_at', 'desc')->sum('amount');
            $totalBalance = $wallet->balance;
            $daily_profit = $wallet->daily_profit;
            $total_profit = $wallet->total_profit;
            //  get the withdrawals
            $totalWidthdraw = $wallet->withdraws()->orderBy('created_at', 'desc')->sum('amount');
            
            // recent account statements
            $recentTransections = AccountStatement::with('paymentMethod', 'user')->where('user_id', auth()->id())->latest()->take(5)->get();
            // recent users        }
        }
    return view('dashboard.index', compact('totalBalance','total_profit','daily_profit', 'totalDeposits','totalWidthdraw','recentUsers','recentTransections'));
}

    // setuppin
    public function setuppin()
    {
        return view('dashboard.account.setuppin');
    }
}
