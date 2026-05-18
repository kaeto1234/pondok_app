<?php

namespace App\Mail;

use App\Models\Santri;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AkunSantriCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $santri;
    public $user;
    public $passwordPlain;

    public function __construct(Santri $santri, User $user, $passwordPlain)
    {
        $this->santri = $santri;
        $this->user = $user;
        $this->passwordPlain = $passwordPlain;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Akun Santri Telah Dibuat - Pondok Pesantren Roudlotut Tullab',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.akun-santri-created',
        );
    }
}