<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Illuminate\Http\Request;

class EnsureTeamIsSubscribed
{
    public function handle(Request $request, Closure $next, ?string $plan = null)
    {
        /** @var Team $team */
        $team = $request->user()->currentTeam;

        if (! $team->activeSubscriptions()->exists()) {
            return redirect()->route('app.subscribe');
        }

        return $next($request);
    }
}
