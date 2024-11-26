<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'currency',
        'pin', // Ensure pin is also fillable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'user_id', 'user_id');
    }
    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'user_id', 'user_id');
    }
}
