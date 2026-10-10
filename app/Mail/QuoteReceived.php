<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class QuoteReceived extends Mailable
{
    public function __construct(public QuoteRequest $quote) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Quote request — '.($this->quote->service ?: 'General'));
    }

    public function content(): Content
    {
        return new Content(view: 'emails.quote');
    }
}
