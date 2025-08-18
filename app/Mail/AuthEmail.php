<?php

namespace App\Mail;

use App\Models\TravelBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AuthEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $buttonRoute;

    /**
     * Create a new message instance.
     */
    public function __construct(TravelBooking $booking,$buttonRoute)
    {
        $this->booking = $booking;
        $this->buttonRoute = $buttonRoute;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Acknowledgement',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'AuthEmails.auth',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
