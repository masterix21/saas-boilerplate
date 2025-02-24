<?php

namespace Tests\Http\Middleware;

use App\Http\Middleware\EnsureTeamIsSubscribed;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use LucaLongo\Subscriptions\Actions\CreateSubscription;
use LucaLongo\Subscriptions\Enums\DurationInterval;
use LucaLongo\Subscriptions\Models\Plan;

beforeEach(function () {
    $this->middleware = new EnsureTeamIsSubscribed();
    $this->user = User::factory()->createOne();
    $this->team = Team::factory()->ownedBy($this->user)->createOne();
    $this->user->currentTeam()->associate($this->team);
    $this->user->save();

    $this->plan = Plan::create([
        'name' => 'Basic Plan',
        'description' => 'Your start point',
        'price' => 9.99,
        'duration_period' => 1,
        'duration_interval' => DurationInterval::MONTH,
        'invoice_period' => 1,
        'invoice_interval' => DurationInterval::MONTH,
    ]);
});

test('redirects to subscribe route if team has no active subscriptions', function () {
    $request = new Request();
    $request->setUserResolver(fn() => $this->user);

    $response = $this->middleware->handle($request, function () {
    });

    expect($response->getTargetUrl())->toBe(route('app.subscribe'));
});

test('allows request to continue if team has active subscriptions', function () {
    (new CreateSubscription)->execute(
        plan: $this->plan,
        subscriber: $this->team,
    );

    $request = new Request();
    $request->setUserResolver(fn() => $this->user);

    $response = null;
    $next = function ($req) use (&$response) {
        $response = 'allowed';
        return $response;
    };

    $result = $this->middleware->handle($request, $next);

    expect($result)->toBe('allowed');
});
