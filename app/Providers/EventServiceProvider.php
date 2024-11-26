<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\DepositCreated' => [
            'App\Listeners\SendDepositNotification',
        ],
        'App\Events\CurrencyExchange' => [
            'App\Listeners\SendCurrencyExchangeNotification',
        ],
        'App\Events\InternalTransfer' => [
            'App\Listeners\SendInternalTransferNotification',
        ],
        'App\Events\WithdrawalRequested' => [
            'App\Listeners\SendWithdrawalNotification',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
