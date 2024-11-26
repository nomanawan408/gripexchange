<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{
    use Queueable;

    public $verificationUrl;


    /**
     * Create a new notification instance.
     */
    public function __construct($verificationUrl)
    {
        $this->verificationUrl = $verificationUrl;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Please Verify Your Email Address')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Thank you for registering with our platform. Please click the button below to verify your email address.')
            ->action('Verify Email Address', $this->verificationUrl)
            ->line('If you did not create an account, no further action is required.')
            ->line('Thank you for using our application!');
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

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', 
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)), 
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}
