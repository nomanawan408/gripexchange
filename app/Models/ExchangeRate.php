<?php

namespace App\Models;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'payment_method_id',
        'buy',
        'sell',
        'deposit_fee',
        'deposit_fee_type',
        'withdraw_fee',
        'withdraw_fee_type',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
