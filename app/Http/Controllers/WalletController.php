<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WalletController extends Controller
{
    //

    public function showSetupPinForm()
    {
        return view('dashboard.account.setup-pin');
    }

    //showResetPinForm
    public function showResetPinForm()
    {
        return view('dashboard.account.reset-wallet-pin');
    }

    public function setupPin(Request $request)
    {
        $request->validate([
            'pin' => 'required|digits:5|confirmed', // Ensure pin is 4 digits and confirmed
        ]);

        $user = Auth::user();
        $wallet = $user->wallet;
        $wallet->pin = bcrypt($request->pin); // Hash the PIN before storing
        $wallet->save();

        return redirect()->route('dashboard.index')->with('success', 'PIN set up successfully.');
    }

    public function resetPin(Request $request)
        {
            $request->validate([
                'current_pin' => 'required|string|min:5|max:5',
                'new_pin' => 'required|string|min:5|max:5|confirmed', // "confirmed" ensures new_pin matches confirm_pin
            ], [
                'current_pin.required' => 'The current PIN is required.',
                'new_pin.required' => 'The new PIN is required.',
                'new_pin.confirmed' => 'The new PIN confirmation does not match.',
            ]);

            $user = Auth::user();
            $wallet = $user->wallet; // Assuming the user has a wallet relationship

            // Verify the current PIN
            if (!Hash::check($request->current_pin, $wallet->pin)) {
                return redirect()->back()->withErrors(['current_pin' => 'The current PIN is incorrect.']);
            }

            // Update the new PIN
            $wallet->pin = Hash::make($request->new_pin);
            $wallet->save();

            return redirect()->route('dashboard.index')->with('success', 'Your wallet PIN has been reset successfully.');
        }

}
