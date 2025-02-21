<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        if (! request()->user()->current_team_id) {
            return $this->guessCurrentTeam();
        }

        return view('teams.index');
    }

    protected function guessCurrentTeam(): RedirectResponse
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
