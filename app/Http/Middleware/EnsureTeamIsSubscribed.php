<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTeamIsSubscribed
{
    public function handle(Request $request, Closure $next, ?string $plan = null)
    {
        return $next($request);
    }
}
