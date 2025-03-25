<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamMember extends Pivot
{
    protected $table = 'team_members';

    protected $fillable = [
        'member_id',
        'team_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
