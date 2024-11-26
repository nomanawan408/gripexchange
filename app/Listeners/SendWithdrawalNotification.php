<?php

namespace App\Listeners;

use App\Events\WithdrawalRequested;
use App\Models\User;
use App\Notifications\WithdrawalNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWithdrawalNotification
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
        $admin->notify(new WithdrawalNotification($event->withdrawal));
    }
}
