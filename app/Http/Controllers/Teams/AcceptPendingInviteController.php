<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\TeamMember;

class AcceptPendingInviteController extends Controller
{
    public function __invoke(Team $team, TeamInvitation $teamInvitation)
    {
        if ($team->getKey() !== $teamInvitation->team_id || $teamInvitation->user_id !== auth()->id()) {
            return redirect()
                ->route('app.dashboard')
                ->with('error', 'You are not invited to this team.');
        }

        TeamMember::create([
            'member_id' => $teamInvitation->user_id,
            'team_id' => $team->getKey(),
        ]);

        auth()->user()->current_team_id = $team->getKey();
        auth()->user()->save();

        $teamInvitation->delete();

        return redirect()
            ->route('app.dashboard')
            ->with('success', 'You have been added to the team!');
    }
}
