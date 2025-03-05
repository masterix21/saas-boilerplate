<?php

namespace App\Models\Concerns;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Model
 */
trait TeamAware
{
    public static function bootTeamAware(): void
    {
        static::addGlobalScope('teamAware', fn ($query) => $query->teamAware());

        static::creating(function (Model $model) {
            $model->team_id ??= auth()->user()->current_team_id;
        });
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeTeamAware(Builder $query): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        $query->where($this->getTable().'.team_id', auth()->user()->current_team_id);
    }
}
