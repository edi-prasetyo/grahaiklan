<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $get_user_email;
    public $validOtp;
    public $get_user_name;
    public $get_user_phone;

    /**
     * Create a new message instance.
     */
    public function __construct($get_user_email, $validOtp, $get_user_name, $get_user_phone)
    {
        $this->get_user_email = $get_user_email;
        $this->validOtp = $validOtp;
        $this->get_user_name = $get_user_name;
        $this->get_user_phone = $get_user_phone;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.welcome',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
