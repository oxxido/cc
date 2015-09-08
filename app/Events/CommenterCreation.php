<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Models\Commenter;

class CommenterCreation extends Event
{
    use SerializesModels;

    public $commenter;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Commenter $commenter)
    {
        $this->commenter = $commenter;
    }

}
