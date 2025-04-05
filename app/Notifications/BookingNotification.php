<?php

namespace App\Notifications;

use App\Models\BookedSession;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingNotification extends Notification
{
    use Queueable;

    public $session;

    public function __construct(BookedSession $session)
    {
        $this->session = $session;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have successfully booked a session.')
                    ->line('Session Title: ' . $this->session->session_title)
                    ->line('Session Date: ' . $this->session->session_date)
                    ->line('Session Time: ' . $this->session->session_time)
                    ->action('View Session', url('/sessions/'.$this->session->id))
                    ->line('Thank you for booking with us!');
    }
}

