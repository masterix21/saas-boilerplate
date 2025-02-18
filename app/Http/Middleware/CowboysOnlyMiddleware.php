<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CowboysOnlyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()?->isCowBoy()) {
            return redirect()->to('/app');
        }

        return $next($request);
    }
}
