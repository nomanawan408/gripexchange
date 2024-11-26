<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\CurrencyExchangeNotification;
use App\Notifications\DepositNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCurrencyExchangeNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
        // Retrieve the admin user(s)
        $admin = User::role('admin')->first();
        // Send the notification
        $admin->notify(new CurrencyExchangeNotification($event->deposit));
    }
}
