<?php

namespace App\Mail;



use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobPosted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
{
    return new Envelope(
        'Job Posted',         // Subject
        'admin@laracasts.com'  // From
    );
}


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            'mail.job-posted'
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