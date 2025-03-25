<?php

namespace App\Policies;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamMemberPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, TeamMember $teamMember): bool
    {
        return $user->belongsToTeam($teamMember->team);
    }

    public function delete(User $user, TeamMember $teamMember): bool
    {
        return $user->getKey() === $teamMember->member_id
            || $user->ownsTeam($teamMember->team);
    }
}
