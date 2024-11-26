<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\User;
use App\Models\Wallet;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'referral_code' => ['nullable', 'string', 'exists:users,referral_code'],
            'phone' => ['required', 'max:50'],
            'country' => ['required', 'string', 'max:50'],
        ]);


        $ref_user = null; // initialize the variable with null value
        if ($request->has('referral_code')) {
            $referral_code = $request->input('referral_code');
            $referrer = User::where('referral_code', $referral_code)->first();
            if ($referrer) {
                $ref_user = $referrer->id;
            } else {
                return redirect()->route('register')->with('error', 'The referral code is not valid.');
            }
        }
    


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone,
            'country' => $request->country,
            'referred_by' => $ref_user,
        ]);

        $user->assignRole('customer');
    
        event(new Registered($user));
        
         // Handle the referral
        if ($user->referred_by) {
            Referral::create([
                'referrer_id' => $user->referred_by,
                'referred_id' => $user->id,
            ]);
        }
        // Create the user's wallet
        Wallet::create([
            'user_id' => $user->id,
            'currency' => 'pkr', // Assuming PKR as default currency, adjust as needed
            'balance' => 0, // Initial balance
        ]);
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
}
