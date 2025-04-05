<?php
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PlanSelected extends Notification
{
    use Queueable;

    protected $plan;

    // Constructor to store the selected plan
    public function __construct($plan)
    {
        $this->plan = $plan;
    }

    // Specify the channels through which the notification will be sent (in this case, email)
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Design the content of the email
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have successfully selected a new plan.')
                    ->line('Plan Name: ' . $this->plan->membership)
                    ->line('Plan Type: ' . $this->plan->plan)
                    ->line('Price: $' . $this->plan->price)
                    ->line('Duration: ' . $this->plan->duration)
                    ->line('Features: ' . $this->plan->features)
                    ->action('View Plan', url('/plans/' . $this->plan->id))
                    ->line('Thank you for choosing our services!');
    }
}
