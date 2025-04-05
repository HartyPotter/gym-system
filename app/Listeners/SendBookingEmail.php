<?php
namespace App\Listeners;

use App\Events\SessionBooked;
use App\Notifications\BookingNotification;
use Illuminate\Support\Facades\Notification;

class SendBookingEmail
{
    public function handle(SessionBooked $event)
    {
        // إرسال البريد الإلكتروني فور الحجز
        $event->session->create_user->notify(new BookingNotification($event->session));
    }
}

