<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CurrencyExchangeNotification extends Notification
{
    use Queueable;

    protected $currencyExchange;

    /**
     * Create a new notification instance.
     */
    public function __construct($currencyExchange)
    {
        $this->currencyExchange = $currencyExchange;
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
    //                 ->subject('Currency Exchange Completed')
    //                 ->line('A currency exchange has been successfully completed.')
    //                 ->action('View Exchange', url('/admin/exchanges/'.$this->currencyExchange->id))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification for the database.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A currency exchange of ' . $this->currencyExchange->amount . 'has been completed.',
            'exchange_id' => $this->currencyExchange->id,
            'from_currency' => $this->currencyExchange->from_currency,
            'to_currency' => $this->currencyExchange->to_currency,
            'created_at' => $this->currencyExchange->created_at,
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
