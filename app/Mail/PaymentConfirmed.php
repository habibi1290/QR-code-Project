<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class PaymentConfirmed extends Mailable
{
    use Queueable, SerializesModels;

   public $paymentDetails;
   protected $qrPath;
    public function __construct($paymentDetails,$qrPath)
    {
        $this->paymentDetails = $paymentDetails;
        $this->qrPath = $qrPath;
    }

    public function build()
    {
        return $this->subject('Zahlungsbestätigung')
            ->markdown('emails.payment.confirmed')
            ->with(['paymentDetails' => $this->paymentDetails])
            ->attach($this->qrPath, [
                'as' => 'ticket-qr-code.png',
                'mime' => 'image/png',
            ]);

    }
}
