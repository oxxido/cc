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

    protected $enabled = true;

    public function __construct()
    {
        if(strpos(url(), "localhost") !== false)
        {
            $this->enabled = false;
        }
    }    

    private function send($options)
    {
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

    public function userRegister($options)
    {
        $this->subject = Lang::get('auth.activateEmailSubject');
        $this->template = "activateAccount";
        $this->send($options);
    }
}