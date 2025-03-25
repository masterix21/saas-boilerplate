<?php

namespace App\Listeners\TeamInvitations;

use App\Events\UserDeleted;
use App\Models\TeamInvitation;

class RemoveDeletedUserListener
{
    public function handle(UserDeleted $event): void
    {
        TeamInvitation::query()
            ->where('user_id', $event->user->getKey())
            ->delete();
    }
}
