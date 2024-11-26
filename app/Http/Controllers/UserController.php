<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
        {
            $users = User::role('customer')->get();            
            return view('dashboard.users.index', compact('users'));
        }
    public function updateCnicStatus(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'in:pending,approved,rejected']
        ]);

        $user = User::findOrFail($request->user_id);
        $user->cnic_status = $request->status;
        $user->save();

        return redirect()->back()->with('message', 'CNIC verification status updated successfully');
    }
}
