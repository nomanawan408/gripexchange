<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function index(Request $request): View
     {
        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
     }
    
    public function edit(Request $request): View
    {
        return view('dashboard.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    //showChangePasswordForm
    public function showChangePasswordForm(){
        return view('dashboard.profile.resetPassword');
    }

    //Change Password 

    public function changePassword(Request $request)
        {
            // Validate form input
            $request->validate([
                'current_password' => 'required|string|min:8',
                'new_password' => 'required|string|min:8|confirmed', // "confirmed" ensures new_password matches new_password_confirmation
            ], [
                'current_password.required' => 'The current password is required.',
                'new_password.required' => 'The new password is required.',
                'new_password.confirmed' => 'The new password confirmation does not match.',
            ]);

            $user = Auth::user();

            // Verify the current password
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
            }

            // Check if the new password is not the same as the current password
            if (Hash::check($request->new_password, $user->password)) {
                return back()->withErrors(['new_password' => 'The new password cannot be the same as the current password.'])->withInput();
            }

            // Update the new password
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('dashboard.index')->with('success', 'Your password has been changed successfully.');
        }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number,' . $request->user()->id],
            'country' => ['required', 'string', 'max:255'],
            // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'transactionpin' => ['required', 'string', 'max:255'],
        ]);
    
        // get the pin of the wallet of auth user.
        $wallet = $request->user()->wallet;

        $user = Auth::user();
        if (!Hash::check($request->transactionpin, $wallet->pin)) {
            return Redirect::back()->withErrors(['transactionpin' => 'The transaction PIN is incorrect.']);
        }
    
        // Update the user data
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->save();
        
        
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');    
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
