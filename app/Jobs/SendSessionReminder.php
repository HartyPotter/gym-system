<?php

namespace App\Jobs;

use App\Models\BookedSession;
use App\Notifications\BookingReminderNotification;

class SendSessionReminder extends Job
{
    public $session;

    public function __construct(BookedSession $session)
    {
        $this->session = $session;
    }

    public function handle()
    {
        // إرسال التذكير قبل موعد الجلسة
        $this->session->create_user->notify(new BookingReminderNotification($this->session));
    }
}

