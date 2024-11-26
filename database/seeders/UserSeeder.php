<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Create an admin user
         $admin = User::create([
            'name' => 'Admin User',
            'phone_number' => '1234567890',
            'country' => 'Pakistan',
            'email' => 'Ma.channal45@gmail.com',
            'password' => bcrypt('Panda8899@'),
            'referral_code' => 'ADMIN123',
        ]);
        $admin->assignRole('admin');

        // Create a customer user
        $customer1 = User::create([
            'name' => 'Customer User',
            'phone_number' => '12345633890',
            'country' => 'Pakistan',
            'email' => 'user1@app.com',
            'password' => bcrypt('password'),
            'referral_code' => 'CUST123',
        ]);
        $customer2 = User::create([
            'name' => 'Customer User',
            'phone_number' => '12345633890',
            'country' => 'Pakistan',
            'email' => 'user2@app.com',
            'password' => bcrypt('password'),
            'referral_code' => 'CUST123',
        ]);
        $customer1->assignRole('customer');
        $customer2->assignRole('customer');
    }
}
