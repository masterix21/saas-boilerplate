<?php

namespace App\Livewire\Forms\Teams;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use App\Notifications\TeamInviteNotification;
use Livewire\Form;

class AddMemberToTeamForm extends Form
{
    public ?string $email;

    public function store(Team $team): void
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        if (auth()->user()->email === $this->email) {
            $this->addError('email', __('You cannot add yourself to the team.'));
            return;
        }

        $invitedUser = User::firstWhere('email', $this->email);

        if ($invitedUser?->belongsToTeam($team)) {
            $this->addError('email', __('This user is already a member of the team.'));
            return;
        }

        $invitation = TeamInvitation::firstOrNew([
            'email' => $this->email,
        ], [
            'team_id' => $team->getKey(),
            'user_id' => $invitedUser?->getKey(),
        ]);

        if ($invitation->exists) {
            $this->addError('email', __('This email is already invited to the team. New invitation has been sent.'));
        } else {
            $invitation->team_id = $team->getKey();
            $invitation->user_id = $invitedUser?->getKey();
            $invitation->save();
        }

        $invitation->notify(new TeamInviteNotification);
    }
}
