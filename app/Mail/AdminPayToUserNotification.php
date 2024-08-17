<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminPayToUserNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $childUser; // The child user object
    public $userName; // The Parent User Name
    public $amount; // The payment amount

    /**
     * Create a new message instance.
     */
    public function __construct($childUser, $userName, $amount)
    {
        $this->childUser = $childUser;
        $this->userName = $userName;
        $this->amount = $amount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Autority Pay You For your child',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.admin_payment_notification',
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
