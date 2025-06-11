<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyHead extends Mailable
{
    use Queueable, SerializesModels;
    public $customMessage;
    public $user;
    public $orders;

    /**
     * Create a new message instance.
     */

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function build()
    {
        return $this->subject('Pending Orders Report')->view('emails.notify_head');
    }


    /*
    public function __construct($customMessage, $user)
    {
        $this->customMessage = $customMessage;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.notify_head')
            ->with([
                'customMessage' => $this->customMessage,
                'user' => $this->user,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Weekly update',
        );
    }

    /**
     * Get the message content definition.
     */


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
