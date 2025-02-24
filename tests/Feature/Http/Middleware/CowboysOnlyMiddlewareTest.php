<?php

namespace Tests\Http\Middleware;

use App\Http\Middleware\CowboysOnlyMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

test('redirects to /app if user is not a cowboy', function () {
    $middleware = new CowboysOnlyMiddleware();

    $user = $this->mock(User::class, function ($mock) {
        $mock->shouldReceive('isCowBoy')->andReturn(false);
    });

    $request = tap(new Request(), fn($r) => $r->setUserResolver(fn() => $user));
    Route::get('/app', fn() => 'Redirected'); // Dummy route for testing redirection

    $response = $middleware->handle($request, fn() => null);

    expect($response->getTargetUrl())->toEndWith('/app');
});

test('allows request to pass if user is a cowboy', function () {
    $middleware = new CowboysOnlyMiddleware();

    $user = $this->mock(User::class, function ($mock) {
        $mock->shouldReceive('isCowBoy')->andReturn(true);
    });

    $request = tap(new Request(), fn ($r) => $r->setUserResolver(fn() => $user));

    $response = $middleware->handle($request, fn() => 'Next middleware called');

    expect($response)->toBe('Next middleware called');
});
