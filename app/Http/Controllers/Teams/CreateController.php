<?php

namespace App\Http\Controllers\Teams;

use App\Actions\Teams\CreateTeam;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CreateController extends Controller
{
    public function show(): View
    {
        return view('teams.create');
    }

    public function create(Request $request, CreateTeam $action): RedirectResponse
    {
        $action->create($request->all(), $request->user());

        return redirect()->route('app.dashboard');
    }
}
