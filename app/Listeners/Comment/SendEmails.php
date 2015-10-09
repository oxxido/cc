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
        $notification = BusinessService::defaultConfig('notification', $business);
        $feedback = BusinessService::defaultConfig('feedback', $business);

        if ($comment->rating >= $feedback->positive_threshold) {
            if ($notification->send_to_owner) {
                EmailService::instance()->positiveFeedback($business->owner->user, $comment);
            }
            if ($notification->send_to_admin && null !== $business->admin) {
                EmailService::instance()->positiveFeedback($business->admin->user, $comment);
            }
            EmailService::instance()->positiveFeedback($comment->businessCommenter->commenter->user, $comment);
        } else {
            if ($notification->send_to_owner) {
                EmailService::instance()->negativeFeedback($business->owner->user, $comment);
            }
            if ($notification->send_to_admin && null !== $business->admin) {
                EmailService::instance()->negativeFeedback($business->admin->user, $comment);
            }
            EmailService::instance()->positiveFeedback($comment->businessCommenter->commenter->user, $comment);
        }
    }
}
