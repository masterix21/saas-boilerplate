<?php

namespace App\Notifications;

use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamInviteNotification extends Notification
{
    public function __construct()
    {
    }

    public function via(User|TeamInvitation $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User|TeamInvitation $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('');
    }

    public function toArray(User|TeamInvitation $notifiable): array
    {
        return $notifiable->toArray();
    }
}
