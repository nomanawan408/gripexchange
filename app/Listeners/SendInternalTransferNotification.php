<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\DepositNotification;
use App\Notifications\InternalTransferNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInternalTransferNotification
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
        $admin->notify(new InternalTransferNotification($event->internalTransfers));
    }
}
