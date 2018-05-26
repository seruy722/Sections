<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordClass extends Mailable
{
    use Queueable, SerializesModels;


    public $title;
    public $subject;
    public $url;
    public $password;


    public function __construct($title,$subject,$url,$password)
    {
        $this->title = $title;
        $this->subject = $subject;
        $this->url = $url;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('resetPasswordMail')->with([
            'title' => $this->title,
            'subject' => $this->subject,
            'phone' => $this->url,
            'password' => $this->password
        ]);
    }
}
