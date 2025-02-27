<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation à rejoindre notre application',
        );
    }

    public function content(): Content
    {
        // On s'assure que l'expiration existe, sinon on met une date par défaut
        $expiration = $this->invitation->expires_at 
            ? Carbon::parse($this->invitation->expires_at)->format('d/m/Y H:i') 
            : Carbon::now()->addHours(24)->format('d/m/Y H:i');

        return new Content(
            view: 'emails.invitation',
            with: [
                'token' => $this->invitation->token,
                'expiration' => $expiration
            ]
        );
    }
}