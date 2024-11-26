<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'details','slug', 'exchange_rate', 'image','account_holder_name','account_number'
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
    
    public function exchangeRates()
    {
        return $this->hasMany(ExchangeRate::class);
    }
    public function exchangeRate()
    {
        return $this->hasOne(ExchangeRate::class);
    }
}
