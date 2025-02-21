<?php

namespace App\Models\Concerns;

use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/** @mixin User */
trait HasTeams
{
    public static function bootHasTeams(): void
    {
        if (! is_subclass_of(static::class, HasPersonalTeam::class)) {
            return;
        }

        static::created(static function ($user) {
            if (! $user->ownedTeams()->exists()) {
                $user->ownedTeams()->create(['name' => __(":first_name's Team", [
                    'first_name' => $user->first_name,
                ])]);
            }

            if ($user->current_team_id) {
                return;
            }

            $user->current_team_id = $user->ownedTeams()->first()->getKey();
            $user->save();
        });
    }

    public function ownsTeam(Team $team): bool
    {
        return $this->getKey() === $team->owner_id;
    }

    public function allTeams(): Collection
    {
        return once(fn () => $this->ownedTeams->merge($this->teams)->sortBy('name'));
    }

    public function ownedTeams(): HasMany
    {
        return $this->hasMany(Team::class, 'owner_id');
    }

    public function teams(): BelongsToMany
    {
        return $this
            ->belongsToMany(Team::class, 'team_members', 'member_id', 'team_id')
            ->using(TeamMember::class);
    }

    public function belongsToTeam(Team $team): bool
    {
        return $this->allTeams()->contains($team);
    }
}
