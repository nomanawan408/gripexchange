<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckWalletPin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

      
        if ($user && (!$user->country || !$user->phone_number || !$user->email)) {
            return redirect()->route('profile.edit', $user->id)->with('error', 'Please complete your profile first.');
        }

        if ($user && $user->wallet && is_null($user->wallet->pin)) {
            return redirect()->route('wallet.setupPin')->with('success', 'Please set up your wallet pin first.');
        }

        return $next($request);
    }
}
