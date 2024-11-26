<?php

namespace App\Http\Controllers;

use App\Models\AccountStatement;
use App\Models\PaymentMethod;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountStatementController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) { // Check if the user has the admin role
            $accountStatements = AccountStatement::with('paymentMethod', 'user')->latest()->get(); // Fetch all account statements with related data
        } else {
            $accountStatements = $user->accountStatements()->with('paymentMethod')->latest()->get(); // Fetch only the authenticated user's account statements
        }


        return view('dashboard.accountstatement.index', compact('accountStatements'));

    }
    public function view()
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) { // Check if the user has the admin role
            $accountStatements = AccountStatement::with('paymentMethod', 'user')->latest()->get(); // Fetch all account statements with related data
        } else {
            $accountStatements = $user->accountStatements()->with('paymentMethod')->latest()->get(); // Fetch only the authenticated user's account statements
        }

        return view('dashboard.accountstatement.view-statement', compact('accountStatements'));
    }

    public function destroy($id)
    {
        $statement = AccountStatement::findOrFail($id);
        $statement->delete();

        return redirect()->route('account-statements.index')->with('success', 'Account statement deleted successfully.');
    }


    public function approve($id)
    { 
        
        $accountStatement = AccountStatement::findOrFail($id);
        $accountStatement->status = 'approved';
        $accountStatement->save();
        
        // Update wallet balance
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $accountStatement->user_id, 'currency' => $accountStatement->currency],
            ['balance' => 0.00]
        );

        if ($accountStatement->deposit) {
            $wallet->balance += $accountStatement->deposit->amount;
            $accountStatement->deposit->status = 'approved';
            $accountStatement->deposit->save();
        }

        if ($accountStatement->withdrawal) {
            $wallet->balance -= $accountStatement->withdrawal->amount;
            $accountStatement->withdrawal->status = 'approved';
            $accountStatement->withdrawal->save();
        }

        $wallet->save();

        return redirect()->route('account-statements.index')->with('success', 'Account statement approved successfully.');
    }
    public function reject($id)
    {
        $accountStatement = AccountStatement::findOrFail($id);
        $accountStatement->status = 'rejected';
        $accountStatement->save();

        if ($accountStatement->deposit) {
            $accountStatement->deposit->status = 'rejected';
            $accountStatement->deposit->save();
        }
        
        return redirect()->route('account-statements.index')->with('alert', 'Account statement rejected successfully.');
    }
}
