<?php

namespace App\Listeners\TeamInvitations;

use App\Models\TeamInvitation;
use Illuminate\Auth\Events\Registered;

class AssociateNewUserListener
{
    public function handle(Registered $event): void
    {
        TeamInvitation::query()
            ->where('email', $event->user->email)
            ->update([
                'user_id' => $event->user->getKey(),
            ]);
    }
}
