<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyExchange extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'from_payment_method_id', 'to_payment_method_id', 'amount', 'converted_amount','exchange_rate',  'fee', 'fee_type' ,'status' ];

    // 

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
