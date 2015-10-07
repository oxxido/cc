<?php namespace App\Events\Business;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class Created extends Event
{
    use SerializesModels;
}
