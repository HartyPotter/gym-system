<?php
namespace App\Events;

namespace App\Events;

use App\Models\BookedSession;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SessionBooked
{
    use Dispatchable, SerializesModels;

    public $session;

    public function __construct(BookedSession $session)
    {
        $this->session = $session;
    }
}
