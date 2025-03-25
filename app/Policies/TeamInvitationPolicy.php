<?php

namespace App\Policies;

use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamInvitationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return filled($user->current_team_id);
    }

    public function view(User $user, TeamInvitation $teamInvitation): bool
    {
        return $user->ownsTeam($teamInvitation->team);
    }

    public function create(User $user): bool
    {
        return filled($user->current_team_id);
    }

    public function update(User $user, TeamInvitation $teamInvitation): bool
    {
        return $user->ownsTeam($teamInvitation->team);
    }

    public function delete(User $user, TeamInvitation $teamInvitation): bool
    {
        return $user->ownsTeam($teamInvitation->team);
    }

    public function restore(User $user, TeamInvitation $teamInvitation): bool
    {
        return $user->ownsTeam($teamInvitation->team);
    }

    public function forceDelete(User $user, TeamInvitation $teamInvitation): bool
    {
        return $user->ownsTeam($teamInvitation->team);
    }
}
