<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $transection;
    /**
     * Create a new message instance.
     */
    public function __construct($order, $transection)
    {
        $this->order = $order;
        $this->transection = $transection;
    }

    public function generatePdf()
    {
        // Use the HTML template and data to generate the PDF invoice
        // Save the PDF to a temporary file or use a PDF generation package
        $data = [
		    'order' => $this->order,
		    'transection' => $this->transection,
		];

		$html = view('user.orderinvoice', $data)->render();
		
        // Example using dompdf package:
        $pdf = \PDF::loadHtml($html);

        return $pdf->output();
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation Mail.',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user.orderinvoice',
            with: [
	            'order' => $this->order,
	            'transection' => $this->transection,
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
        return [
            Attachment::fromData(fn () => $this->generatePdf(), 'Invoice.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
