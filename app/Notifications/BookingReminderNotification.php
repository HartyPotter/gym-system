<?php

namespace App\Notifications;

use App\Models\BookedSession;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingReminderNotification extends Notification
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
                    ->line('This is a reminder for your upcoming session.')
                    ->line('Session Title: ' . $this->session->session_title)
                    ->line('Session Date: ' . $this->session->session_date)
                    ->line('Session Time: ' . $this->session->session_time)
                    ->line('Please be prepared!')
                    ->action('View Session', url('/sessions/'.$this->session->id))
                    ->line('Thank you!');
    }
}
