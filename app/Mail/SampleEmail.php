<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SampleEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $name;
    protected $username;
    protected $welcomeMessage;
    protected $startLink;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $username, $welcomeMessage, $startLink)
    {
        $this->name = $name;
        $this->username = $username;
        $this->welcomeMessage = $welcomeMessage;
        $this->startLink = $startLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sample Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.mailTemplate',
            with: [
                'name' => $this->name,
                'username' => $this->username,
                'welcomeMessage' => $this->welcomeMessage,
                'startLink' => $this->startLink
            ],
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
