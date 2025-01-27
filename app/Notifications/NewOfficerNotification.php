<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOfficerNotification extends Notification
{
    private $username;
    private $password;
    private $namaPetugas;

    public function __construct($namaPetugas, $username, $password)
    {
        $this->namaPetugas = $namaPetugas;
        $this->username = $username;
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your New Officer Account')
            ->greeting('Hello ' . $this->namaPetugas . ',')
            ->line('Your officer account has been successfully created.')
            ->line('Here are your account details:')
            ->line('**Username**: ' . $this->username)
            ->line('**Password**: ' . $this->password)
            ->action('Login Here', config('app.url') . '/login')
            ->line('Please log in using the credentials above.')
            ->salutation('Thank you!');
    }    
}
