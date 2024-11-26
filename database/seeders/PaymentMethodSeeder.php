<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'title' => 'Bitcoin',
                'slug' => 'bitcoin',
                'details' => 'Details about Bitcoin',
                'exchange_rate' => 18746547,
                'image' => 'bitcoin.png',
                'account_holder_name' => '-',
                'account_number' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh'
            ],
            [
                'title' => 'USD TTRC20',
                'slug' => 'usd-ttrc20',
                'details' => 'Details about USD TTRC20',
                'exchange_rate' => 296,
                'image' => 'usdttrc20.jpg',
                'account_holder_name' => 'Frank Yellow',
                'account_number' => 'USDT123456789'
            ],
        ];
        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}
