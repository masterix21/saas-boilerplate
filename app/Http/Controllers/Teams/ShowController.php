<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ShowController extends Controller
{
    public function show(Team $team): View|RedirectResponse
    {
        return view('teams.show', [
            'currentTeam' => $team,
        ]);
    }
}
