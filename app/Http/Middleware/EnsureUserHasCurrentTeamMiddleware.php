<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasCurrentTeamMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()->current_team_id) {
            return redirect()->route('app.teams');
        }

        return $next($request);
    }
}
