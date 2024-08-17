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

class MlmInvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoiceData;
    /**
     * Create a new message instance.
     */
    public function __construct($invoiceData)
    {
        $this->invoiceData = $invoiceData;
    }

    public function generatePdf()
    {
        // Use the HTML template and data to generate the PDF invoice
        // Save the PDF to a temporary file or use a PDF generation package
        $html = view('user.mlminvoice', $this->invoiceData)->render();
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
            subject: $this->invoiceData['title'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'user.mlminvoice',
            with: $this->invoiceData
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
            Attachment::fromData(fn () => $this->generatePdf(), 'MlmInvoice.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
