<?php

namespace App\Livewire\Forms;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use App\Notifications\TeamInviteNotification;
use Illuminate\Validation\Rule;
use Livewire\Form;

class AddMemberToTeamForm extends Form
{
    public Team $team;
    public string $email;

    public function store(): void
    {
        $this->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->where('team_id', $this->team->getKey()),
            ],
        ]);

        $user = User::firstWhere('email', $this->email);

        $invitation = TeamInvitation::create([
            'team_id' => $this->team->getKey(),
            'user_id' => $user?->getKey(),
            'email' => $this->email,
        ]);

        if ($user) {
            $user->notify(new TeamInviteNotification);
            return;
        }

        $invitation->notify(new TeamInviteNotification);
    }
}
