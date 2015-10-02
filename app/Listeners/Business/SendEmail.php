<?php namespace App\Listeners\Business;

use App\Events\Business\Created;
use App\Events\Event;
use App\Models\Business;
use App\Services\EmailService;

class SendEmail
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  Comment $comment
     *
     * @return void
     */
    public function handle(Business $business)
    {
        if ($business->admin->user->id != $business->owner->id)
        {
            EmailService::instance()->businessCreated($business);
        }
    }
}
