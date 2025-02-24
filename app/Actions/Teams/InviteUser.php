<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Models\User;

class InviteUser
{
    public function invite(Team $team, User $user): bool
    {
        if ($user->belongsToTeam($team)) {
            return true;
        }

    }
}
