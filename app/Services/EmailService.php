<?php namespace App\Services;

use Mail;
use Lang;

class EmailService
{
    public $subject;
    public $template;
    public $from = "gerardo@rosciano.com.ar";
    public $data = array();
    public $to = "gerardo@rosciano.com.ar";

    protected $disabled = false;

    public function __construct()
    {
        if(strpos(url(), "localhost") !== false)
        {
            //$this->disabled = true;
        }
    }    

    private function send($options)
    {
        if($this->disabled)
            return;

        $this->data = isset($options['data']) ? $options['data'] : $this->data;
        $this->to = isset($options['to']) ? $options['to'] : $this->to;

        $that = $this;
        Mail::queue("emails.{$that->template}", $that->data, function($message) use ($that) {
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

    public function contact($options)
    {
        $this->subject = "Contact form";
        $this->template = "contact";
        $this->send($options);
    }

    public function invite($options)
    {
        $this->subject = "Request an invite";
        $this->template = "invite";
        $this->send($options);
    }

    public function ownerCreation($options)
    {
        $this->subject = "Welcome New Owner";
        $this->template = "ownerWelcome";
        $this->send($options);
    }

    public function adminCreation($options)
    {
        $this->subject = "Welcome New Admin";
        $this->template = "adminWelcome";
        $this->send($options);
    }

    public function userCreation($options)
    {
        $this->subject = Lang::get('auth.activateEmailSubject');
        $this->template = "activateAccount";
        $this->send($options);
    }

    public function commenterCreation($options)
    {
        $this->subject = "Welcome New Commenter";
        $this->template = "commenterWelcome";
        $this->send($options);
    }

    public static function instance()
    {
        return new self();
    }
}