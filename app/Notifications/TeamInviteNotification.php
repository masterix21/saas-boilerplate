<?php

namespace App\Notifications;

use App\Models\TeamInvitation;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class TeamInviteNotification extends Notification
{
    public function __construct()
    {
    }

    public function via(TeamInvitation $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(TeamInvitation $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Would you like to join :team?', ['team' => $notifiable->team->name]))
            ->line(__('You have been invited to join the team :team', ['team' => $notifiable->team->name]))
            ->line(__('Please click the button below to accept the invitation.'))
            ->action(__('Accept'), URL::signedRoute('app.teams.invites.accept', [
                'team' => $notifiable->team,
                'teamInvitation' => $notifiable,
            ]))
            ->line(__('If you think this is a mistake, please ignore this email.'));
    }

    public function toArray(TeamInvitation $notifiable): array
    {
        return $notifiable->toArray();
    }
}
