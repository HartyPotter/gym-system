<?php

namespace App\Listeners;

use App\Events\CustomerRegistered;
use App\Notifications\CustomerRegistered as CustomerRegisteredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail implements ShouldQueue
{
    public function handle(CustomerRegistered $event)
    {
        // إرسال الإشعار بالبريد الإلكتروني
        $event->customer->notify(new CustomerRegisteredNotification());
    }
}
