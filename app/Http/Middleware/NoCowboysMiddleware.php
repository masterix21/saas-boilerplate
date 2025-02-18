<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoCowboysMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()?->isCowBoy()) {
            return redirect()->to('/master');
        }

        return $next($request);
    }
}
