<?php namespace App\Listeners\Comment;

use App\Events\Comment\Created;
use App\Events\Event;
use App\Models\Comment;
use App\Services\BusinessService;
use App\Services\EmailService;
use App\Services\FeedbackService;

class SendEmails
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
        $business = $comment->product->business;
        $config = BusinessService::defaultConfig('all', $business);
        $notification = $config->notification;

        if ($comment->rating >= $config->feedback->positive_threshold) {
            if ($notification->send_to_owner) {
                EmailService::instance()->positiveFeedback($business->owner);
            }
            if ($notification->send_to_admin) {
                EmailService::instance()->positiveFeedback($business->admin->user);
            }
        } else {
            if ($notification->send_to_owner) {
                EmailService::instance()->negativeFeedback($business->owner);
            }
            if ($notification->send_to_admin) {
                EmailService::instance()->negativeFeedback($business->admin->user);
            }
        }
    }
}
