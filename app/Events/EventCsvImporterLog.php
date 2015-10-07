<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventCsvImporterLog extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $user_id;
    public $log;
    public $type;
    public $datetime;
    public $line;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id, $log, $type, $line)
    {
        $this->user_id = $user_id;
        $this->log = $log;
        $this->type = $type;
        $this->datetime = date("H:i:s");
        $this->line = $line;
    }


    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['user.'. $this->user_id];
    }
}
