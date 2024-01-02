<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordExpiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $userObj;
    public $messageObj;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $userObj,$messageObj)
    {
        $this->userObj = $userObj;
        $this->messageObj = $messageObj;
    }

    public function build()
    {
        return $this->view('Email.password-expiry-notification')
                    ->subject('Password Expiry Notification');
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Password Expiry Notification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'Email.password-expiry-notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

