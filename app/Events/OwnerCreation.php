<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Models\Owner;

class OwnerCreation extends Event
{
    use SerializesModels;

    public $owner;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Owner $owner)
    {
        $this->owner = $owner;
    }

}
