<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class SetLanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $language = auth()->user()?->language ?: $request->getPreferredLanguage(config('app.supported_locales'));

        app()->setLocale($language);

        Number::useLocale($language);

        return $next($request);
    }
}
