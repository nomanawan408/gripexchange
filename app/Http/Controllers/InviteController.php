<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InviteController extends Controller
{
    //
    public function index(){
        $referrals = auth()->user()->referrals;
                $referredUsers = auth()->user()->referredUsers;
        
    return view('dashboard.invite.index', compact('referrals', 'referredUsers'));
        
    }
}
