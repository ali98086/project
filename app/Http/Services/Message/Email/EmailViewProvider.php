<?php

namespace App\Http\Services\Message\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailViewProvider extends Mailable
{
    use Queueable, SerializesModels;

    public $metadata, $attachFiles;
    /**
     * Create a new message instance.
     */
    public function __construct($details, $attachFiles = null)
    {
        $this->metadata = $details;
        $this->attachFiles = $attachFiles;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'کد احراز هویت',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send-otp',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $mailPathFiles= [];
        foreach($this->attachFiles as $filePath){

            array_push($mailPathFiles, public_path($filePath));

        }
        return $mailPathFiles;
    }
}
