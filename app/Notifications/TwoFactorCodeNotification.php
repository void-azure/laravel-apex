<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

/**
 * The nexmo notification.
 */
class TwoFactorCodeNotification extends Notification
{
    use Queueable;

    /** @var string $two_factor_code The 2 factor code to send. */
    public $two_factor_code;

    /**
     * Create a new notification instance.
     *
     * @param string $two_factor_code The 2 factor code to send.
     *
     * @return void Returns nothing.
     */
    public function __construct($two_factor_code)
    {
        $this->two_factor_code = $two_factor_code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable Get the notifiable.
     *
     * @return array Returns an array of data.
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the sms representation of the notification.
     *
     * @param mixed $notifiable Get the notifiable.
     *
     * @return Illuminate\Notifications\Messages\NexmoMessage Returns the sms message.
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)->content("Your two factor code is {$this->two_factor_code}")->unicode();
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
