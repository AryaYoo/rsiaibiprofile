<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Appointment $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[RSIA IBI] Konfirmasi Pendaftaran — ' . $this->appointment->kode_pendaftaran,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment-confirmation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
