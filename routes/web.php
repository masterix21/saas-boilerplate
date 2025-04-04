<?php

use App\Http\Controllers\Subscriptions\SubscribePlanController;
use App\Http\Controllers\Teams\AcceptPendingInviteController;
use App\Http\Middleware\BelongsToTeamMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/app')->middleware('auth');

Route::get('/terms', fn () => 'terms')->name('terms')->middleware('password.confirm');
Route::get('/policy', fn () => 'policy')->name('policy');

Route::view('profile', 'profile')
    ->name('profile')
    ->middleware('auth');

Route::name('app.')
    ->middleware(['auth', 'verified', 'no-cowboys'])
    ->prefix('/app')
    ->group(function () {

        Route::get('subscribe', [SubscribePlanController::class, 'index'])
            ->middleware('team-members')
            ->name('subscribe');

        Route::get('subscribe/{plan}/{gateway}', \App\Http\Controllers\Subscriptions\BuyController::class)
            ->middleware('team-members')
            ->name('subscription-payment');

        Route::get('teams', \App\Http\Controllers\Teams\IndexController::class)->name('teams');

        Route::get('teams/create', [\App\Http\Controllers\Teams\CreateController::class, 'show'])->name('teams.create');
        Route::post('teams/create', [\App\Http\Controllers\Teams\CreateController::class, 'create']);

        Route::get('teams/{team}/invites/{teamInvitation}/accept', AcceptPendingInviteController::class)
            ->middleware('signed')
            ->name('teams.invites.accept');

        Route::group(['middleware' => ['can:view,team'], 'prefix' => 'teams/{team}'], function () {
            Route::get('/', [\App\Http\Controllers\Teams\ShowController::class, 'show'])->name('teams.show');
            Route::get('/members', [\App\Http\Controllers\Teams\ShowController::class, 'show'])->name('teams.show-members');
            Route::get('/billing', [\App\Http\Controllers\Teams\ShowController::class, 'show'])->name('teams.show-billing');
        });

        Route::group(['middleware' => ['team-members', 'subscribed']], function () {
            Route::view('/', 'dashboard')->name('dashboard');
        });
    });
