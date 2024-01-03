<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProofOfPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $first_name;
    protected $last_name;
    protected $amount;
    protected $hours;
    protected $date;
    public function __construct($first_name,$last_name,$amount,$hours,$date)
    {

        $this->first_name=$first_name;
        $this->last_name=$last_name;
        $this->amount=$amount;
        $this->hours=$hours;
        $this->date=$date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank you for your purchase!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.ProofOfPayment',
            with: [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'amount' => $this->amount,
                'hours' => $this->hours,
                'date' => $this->date


            ]
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
