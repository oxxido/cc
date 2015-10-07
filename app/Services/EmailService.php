<?php namespace App\Services;

use App\Models\BusinessCommenter;
use App\Models\Business;
use App\Models\Comment;
use App\Models\User;
use Mail;
use Lang;

class EmailService
{
    public $subject;

    public $template;

    public $from = "info@certifiedcomments.com";

    public $data = [];

    public $to = "oxxido@gmail.com";

    protected $disabled = false;

    private function send($options)
    {
        if ($this->disabled) {
            return;
        }

        $this->data = isset($options['data']) ? $options['data'] : $this->data;
        $this->to   = isset($options['to']) ? $options['to'] : $this->to;

        $that = $this;
        Mail::queue("emails.{$that->template}", $that->data, function ($message) use ($that) {
            $message->from($that->from);
            $message->subject($that->subject);
            $message->to($that->to);
        });
        /*
        //get template from db
        $template = Template::first();
        $msg = \DbView::make($template)->with($data)->render();
        \Mail::raw($msg, function($message) use ($user) {
            $message->from("gerardo@rosciano.com.ar");
            $message->subject( \Lang::get('auth.activateEmailSubject') );
            $message->to($user->email);
        });*/
    }

    public function contact($data)
    {
        $this->subject  = "Contact form";
        $this->template = "contact";
        $this->send(['data' => $data]);
    }

    public function invite($data)
    {
        $this->subject  = "Request an invite";
        $this->template = "invite";
        $this->send(['data' => $data]);

        $this->subject = 'Thanks';
        $this->template = 'thanks';
        $this->send(['data' => $data, 'to' => $data['email']]);
    }

    public function userCreation($user, $options)
    {
        $this->subject = Lang::get('auth.activateEmailSubject');

        if (isset($options['send_password']) && $options['send_password']) {
            $this->template = "activateAccountPassword";
        } elseif (isset($options['resend']) && $options['resend']) {
            $this->template = "activateAccountResend";
        } else {
            $this->template = "activateAccount";
        }

        $this->send([
            'to'   => $user->email,
            'data' => [
                'name'     => $user->name,
                'code'     => $user->activation_code,
                'password' => isset($options['send_password']) ? $options['password'] : false
            ]
        ]);
    }

    public function ownerCreation($user, $options)
    {
        $this->subject  = "Welcome New Owner";
        $this->template = "ownerWelcome";
        $this->send([
            'to'   => $user->email,
            'data' => [
                'name' => $user->name
            ]
        ]);
    }

    public function adminCreation($user, $options)
    {
        $this->subject  = "Welcome New Admin";
        $this->template = "adminWelcome";
        $this->send([
            'to'   => $user->email,
            'data' => [
                'name' => $user->name
            ]
        ]);
    }

    public function commenterCreation($user, $options)
    {
        $this->subject  = "Welcome New Commenter";
        $this->template = "commenterWelcome";
        $this->send([
            'to'   => $user->email,
            'data' => [
                'name' => $user->name
            ]
        ]);
    }

    public static function instance()
    {
        return new self();
    }

    /**
     * @param User    $user
     * @param Comment $comment
     */
    public function positiveFeedback(User $user, Comment $comment)
    {
        $business = $comment->product->business;
        $this->subject  = $business->config->email->positive_feedback_subject;
        $this->template = "positiveFeedback";
        $this->send([
            "to"   => $user->email,
            "data" => [
                "header"  => BusinessService::tagsReplace([
                    "text" => $business->config->email->positive_feedback_body,
                    "comment" => $comment,
                    "business" => $business,
                    "section" => "header"
                ]),
                "footer"  => BusinessService::tagsReplace([
                    "text" => $business->config->email->positive_feedback_body,
                    "comment" => $comment,
                    "business" => $business,
                    "section" => "footer"
                ]),
                "links" => $business->links
            ]
        ]);
    }

    /**
     * @param User    $user
     * @param Comment $comment
     */
    public function negativeFeedback(User $user, Comment $comment) {
        $business = $comment->product->business;
        $this->subject  = $business->config->email->negative_feedback_subject;
        $this->template = "negativeFeedback";
        $this->send([
            "to"   => $user->email,
            "data" => [
                "body"  => BusinessService::tagsReplace([
                    "text" => $business->config->email->negative_feedback_body,
                    "comment" => $comment,
                    "business" => $business
                ])
            ]
        ]);
    }

    public function performanceReport(Business $business)
    {
        $owner = $business->owner;
        $this->subject  = "Performance report";
        $this->template = "performanceReport";
        $this->send([
            'to'   => $owner->email,
            'data' => [
                'name' => $owner->name,
                'business' => $business
            ]
        ]);
    }

    public function requestFeedback(BusinessCommenter $business_commenter)
    {
        $business = $business_commenter->business;
        $commenter = $business_commenter->commenter;

        $this->subject  = $business->config->email->feedback_request_subject;
        $this->template = "feedbackRequest";
        $this->from = $business->config->email->feedback_request_from;
        $body = BusinessService::tagsReplace([
            'text' => $business->config->email->feedback_request_body,
            'business' => $business,
            'commenter' => $commenter
        ]);

        $this->send([
            'to'   => $commenter->email,
            'data' => [
                'name' => $commenter->name,
                'body' => $body
            ]
        ]);
    }

    public function businessCreated(Business $business)
    {
        $owner = $business->owner;
        $this->subject  = "New Business Created";
        $this->template = "newBusinessCreated";
        $this->send([
            'to'   => $owner->email,
            'data' => [
                'name' => $business->admin->user->name,
                'business' => $business->name
            ]
        ]);
    }
}
