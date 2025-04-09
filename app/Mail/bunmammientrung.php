<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class bunmammientrung extends Mailable
{
    use Queueable, SerializesModels;

    public $sentData;

    public function __construct($sentData)
    {
        $this->sentData = $sentData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: '20ts079@danavtc.edu.vn',
            subject: 'Yêu cầu cấp lại mật khẩu',
            replyTo: ['20ts079@danavtc.edu.vn']
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.interfaceEmail',
            with: [
                'sentData' => $this->sentData
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
