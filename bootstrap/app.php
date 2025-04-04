<?php

use App\Http\Middleware\CowboysOnlyMiddleware;
use App\Http\Middleware\EnsureTeamIsSubscribed;
use App\Http\Middleware\EnsureUserHasCurrentTeamMiddleware;
use App\Http\Middleware\NoCowboysMiddleware;
use App\Http\Middleware\SetLanguageMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web([
            SetLanguageMiddleware::class,
        ]);

        $middleware->alias([
            'no-cowboys' => NoCowboysMiddleware::class,
            'cowboys-only' => CowboysOnlyMiddleware::class,
            'team-members' => EnsureUserHasCurrentTeamMiddleware::class,
            'subscribed' => EnsureTeamIsSubscribed::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            'hooks/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
