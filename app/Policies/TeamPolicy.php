<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Team $team): bool
    {
        return $user->belongsToTeam($team);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function delete(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function restore(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function forceDelete(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }

    public function addMember(User $user, Team $team): bool
    {
        return $user->ownsTeam($team);
    }
}
