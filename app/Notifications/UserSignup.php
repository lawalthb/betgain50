<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSignup extends Notification
{
    use Queueable;

    protected $first_name;
    protected $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $first_name)
    {
        $this->first_name = $first_name;
        $this->token = $token;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to BetGain')
            ->greeting('Hello ' . $this->first_name . ',')
            ->line('We are happy to welcome you to BetGain')
            ->line('BetGain is your ultimate destination for unforgettable betting experiences!')
            ->line('We are delighted to have you on board and can\'t wait to introduce you to the thrill and excitement that awaits you in the world of crash game betting.')
            ->line('Kindly use the button below to verify your email address.')
            ->action('Click here to login', url('/token' . '/' . $this->token))
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
}
