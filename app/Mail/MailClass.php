<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailClass extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public function __construct($name, $email, $phone, $subject, $msg)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->subject = $subject;
        $this->msg = $msg;
    }


    public function build()
    {
        return $this->view('mail')
            ->with([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'subject' => $this->subject,
                'msg' => $this->msg,
            ]);
    }
}