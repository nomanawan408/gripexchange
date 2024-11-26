<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Setting;
class SettingController extends Controller
{
    //
    public function index(){
       // Fetch settings from the database
        $referal_profit_percentage = Setting::where('key', 'referal_profit_percentage')->value('value');
        $daily_profit_percentage = Setting::where('key', 'daily_profit_percentage')->value('value');

        return view('dashboard.setting.index', compact('daily_profit_percentage','referal_profit_percentage')); 
    }

    public function update(Request $request)
    {
        $request->validate([
            'referal_profit_percentage' => 'nullable|numeric|min:0|max:100',
            'daily_profit_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        // Update settings in the database
        if ($request->has('referal_profit_percentage')) {
            Setting::updateOrCreate(
                ['key' => 'referal_profit_percentage'],
                ['value' => $request->input('referal_profit_percentage')]
            );
        }

        if ($request->has('daily_profit_percentage')) {
            Setting::updateOrCreate(
                ['key' => 'daily_profit_percentage'],
                ['value' => $request->input('daily_profit_percentage')]
            );
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
    
}
