<?php namespace App\Services;

use App\Models\Business;
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

    public function positiveFeedback($user)
    {
        $this->subject  = "Positive feedback received";
        $this->template = "positiveFeedback";
        $this->send([
            'to'   => $user->email,
            'data' => [
                'name' => $user->name
            ]
        ]);
    }

    public function negativeFeedback($user) {
        $this->subject  = "Negative feedback received";
        $this->template = "negativeFeedback";
        $this->send([
            'to'   => $user->email,
            'data' => [
                'name' => $user->name
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
}
