<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailQueued extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable)
    {
        $frontendUrl = config('app.frontend_url') . '?url=' . urlencode($this->verificationUrl($notifiable));

        return (new MailMessage)
            ->subject('Verifica tu correo electrónico de tu cuenta de facturación electrónica')
            ->view('emails.verify-email', [
                'url' => $frontendUrl,
                'user' => $notifiable
            ]);
    }

    // public function via($notifiable)
    // {
    //     return ['mail'];
    // }

    // public function toMail($notifiable)
    // {
    //     return (new \Illuminate\Notifications\Messages\MailMessage)
    //         ->subject('Test Notificación')
    //         ->line('Este es un correo de prueba.');
    // }
}
