<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
//  include Str class
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'country',
        'password',
        'referred_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Get all wallets associated with the user.
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function accountStatements()
    {
        return $this->hasMany(AccountStatement::class);
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->referral_code = Str::random(10); // Generate a random referral code
        });
    }

    public function sendEmailVerificationNotification()
    {
        // Generate the verification URL
        $verificationUrl = $this->verificationUrl();

        // Send the custom email notification with the verification URL
        $this->notify(new VerifyEmail($verificationUrl));
    }

    /**
     * Generate the email verification URL.
     *
     * @return string
     */
    protected function verificationUrl()
    {
        return URL::temporarySignedRoute(
            'verification.verify', 
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)), 
            ['id' => $this->getKey(), 'hash' => sha1($this->getEmailForVerification())]
        );
    }
}
