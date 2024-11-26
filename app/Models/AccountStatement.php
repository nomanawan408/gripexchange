<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStatement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'deposit_id',
        'withdraw_id',
        'internal_transfer_id',
        'amount',
        // 'currency',
        // 'customer_account_name',
        // 'customer_account_number',
        'customer_transaction_id',
        'receipt_path',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    public function withdraw()
    {
        return $this->belongsTo(Withdraw::class);
    }
    // make relation for internal transfer

    public function internalTransfer(){
        return $this->belongsTo(InternalTransfer::class);
    }
}