<?php

namespace App\Mail;

use App\Models\BookingEnquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingEnquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public BookingEnquiry $enquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New website trip enquiry',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-enquiry',
        );
    }
}
