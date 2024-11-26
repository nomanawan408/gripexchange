<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Setting::updateOrCreate(['key' => 'referal_profit_percentage'], ['value' => '1']); // Default 1%
        Setting::updateOrCreate(['key' => 'daily_profit_percentage'], ['value' => '5']);     // Default 5% 
    }
}
