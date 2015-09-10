<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserEmailEvent extends Event
{
    use SerializesModels;

    public $user;
    public $role;
    public $options;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $role = "user", $options = array())
    {
        $this->user = $user;
        $this->role = $role;
        $this->options = $options;
    }

}
