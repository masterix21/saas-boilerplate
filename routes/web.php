<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/app')->middleware('auth');

Route::get('/terms', fn () => 'terms')->name('terms');
Route::get('/policy', fn () => 'policy')->name('policy');

Route::name('profile.')
    ->middleware('auth')
    ->prefix('profile')
    ->group(function () {
        Route::view('/', 'profile.show')->name('show');
    });

Route::name('app.')
    ->middleware(['auth', 'verified'])
    ->prefix('/app')
    ->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');
    });
