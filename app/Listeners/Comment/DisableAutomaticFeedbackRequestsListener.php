<?php namespace App\Listeners\Comment;

use App\Events\Comment\Created;
use App\Events\Event;
use App\Models\Comment;
use App\Services\BusinessService;
use App\Services\EmailService;
use App\Services\FeedbackService;

class DisableAutomaticFeedbackRequestsListener
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
    public function handle(Comment $comment)
    {
        $business_commenter = $comment->businessCommenter()->first();
        $business_commenter->request_feedback_automatically = false;
        $business_commenter->save();
    }
}
