<?php

namespace App\Mail;

use App\Models\Painting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $email;
    private $painting;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($painting, string $email)
    {
        $this->email = $email;
        $this->painting = $painting;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(env('MAIL_USERNAME', 'Dmytro Dotsenko')),
            subject: '"' . $this->painting['name']  .'"',
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
            view: 'order',
            with: [
                'painting' => $this->painting,
                'email' => $this->email,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
//            Attachment::fromStorage($this->painting['image'])
//                ->withMime('application/jpg'),
        ];
    }
}
