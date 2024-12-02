<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $personalInfo;

    /**
     * Create a new message instance.
     */
    public function __construct($personalInfo)
    {
        $this-> personalInfo = $personalInfo;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Your Email Subject')
                    ->view('emails.OfficerMail') // Points to the email view file
                    ->with('personalInfo', $this->personalInfo);
    }
}
