<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->subject('Nouveau message depuis le formulaire de contact - ' . $this->data['subject'])
            ->greeting('Nouveau message reçu')
            ->line('Vous avez reçu un nouveau message depuis le formulaire de contact du site.')
            ->line('**Informations :**')
            ->line('Nom : ' . $this->data['name'])
            ->line('Email : ' . $this->data['email']);

        if (!empty($this->data['phone'])) {
            $mailMessage->line('Téléphone : ' . $this->data['phone']);
        }

        $mailMessage->line('Sujet : ' . $this->data['subject'])
            ->line('**Message :**')
            ->line($this->data['message'])
            ->action('Répondre par email', 'mailto:' . $this->data['email']);

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'phone' => $this->data['phone'] ?? null,
            'subject' => $this->data['subject'],
            'message' => $this->data['message'],
        ];
    }
}
