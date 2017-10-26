<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\User;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    
    private $data = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact with our site')->markdown('emails.tmpl', [
            'msg' => $this->data['message'],
            'user' => $this->data['name'],
            'email' => $this->data['email'],
        ]);
    }
}
