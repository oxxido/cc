<?php namespace App\Events\Comment;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class Created extends Event
{
    use SerializesModels;
}
