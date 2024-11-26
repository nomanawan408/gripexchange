<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all users
        $users = User::all();
        foreach ($users as $user) {
            // Check if the user already has a wallet for a specific currency, if not create one
            $currencies = ['PKR']; // Add other currencies as needed

            foreach ($currencies as $currency) {
                Wallet::firstOrCreate(
                    ['user_id' => $user->id, 'currency' => $currency],
                    ['balance' => 0.00]
                );
            }
        }
    }
}
