<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InternalTransferNotification extends Notification
{
    use Queueable;

    protected $internalTransfer;

    /**
     * Create a new notification instance.
     */
    public function __construct($internalTransfer)
    {
        $this->internalTransfer = $internalTransfer;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
      */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->subject('Internal Transfer Completed')
    //                 ->line('An internal transfer has been successfully completed.')
    //                 ->action('View Transfer', url('/admin/transfers/'.$this->internalTransfer->id))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification for the database.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'An internal transfer of ' . $this->internalTransfer->amount . ' has been completed.',
            'transfer_id' => $this->internalTransfer->id,
            'from_user' => $this->internalTransfer->from_user_id,
            'to_user' => $this->internalTransfer->to_user_id,
            'created_at' => $this->internalTransfer->created_at,
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
