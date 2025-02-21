<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdminNotification extends Notification
{
    private $password;
    private $namaPetugas;

    public function __construct($namaPetugas, $password)
    {
        $this->namaPetugas = $namaPetugas;
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your New Admin Account')
            ->greeting('Hello ' . $this->namaPetugas . ',')
            ->line('Your admin account has been successfully created.')
            ->line('Here are your account details:')
            ->line('**Password**: ' . $this->password)
            ->action('Login Here', config('app.url') . '/login')
            ->line('Please log in using the credentials above.')
            ->salutation('Thank you!');
    }
}
