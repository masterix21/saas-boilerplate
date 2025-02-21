<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;

class IndexController extends Controller
{
    public function __invoke()
    {
        if (! request()->user()->current_team_id) {
            return $this->guessCurrentTeam();
        }

        return view('teams.index');
    }

    protected function guessCurrentTeam()
    {
        $user = request()->user();
        $teams = $user->allTeams();

        if ($teams->isEmpty()) {
            return redirect()->route('app.teams.create');
        }

        $team = $teams
            ->sortBy(fn (Team $team) => $team->owner_id === $user->id ? 1 : 0)
            ->first();

        $user->current_team_id = $team->id;
        $user->save();

        return redirect()->route('app.dashboard');
    }
}
