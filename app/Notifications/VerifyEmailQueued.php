<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmailQueued extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable)
    {
        $frontendUrl = config('app.frontend_url') . '?url=' . urlencode($this->verificationUrl($notifiable));

        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('xd')
            ->line('Lolo')
            ->action('Verificar ', $frontendUrl);
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
