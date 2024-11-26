<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangeRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Fetch all payment methods
       $paymentMethods = PaymentMethod::all();

       foreach ($paymentMethods as $paymentMethod) {
           DB::table('exchange_rates')->insert([
               'payment_method_id' => $paymentMethod->id,
               'buy' => $this->generateRandomRate(), // Example method to generate a random rate
               'sell' => $this->generateRandomRate(), // Example method to generate a random rate
               'deposit_fee' => $this->generateRandomFee(), // Example method to generate a random fee
               'withdraw_fee' => $this->generateRandomFee(), // Example method to generate a random fee
               'created_at' => now(),
               'updated_at' => now(),
           ]);
       }
    }
    private function generateRandomRate()
    {
        return round(mt_rand(1000, 1500) / 10000, 4); // Generates a random rate between 0.1000 and 0.1500
    }

    /**
     * Generate a random fee.
     *
     * @return float
     */
    private function generateRandomFee()
    {
        return round(mt_rand(100, 500) / 10000, 4); // Generates a random fee between 0.0100 and 0.0500
    }
}
