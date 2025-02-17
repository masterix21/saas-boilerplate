<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/app')->middleware('auth');

Route::get('/terms', fn () => 'terms')->name('terms');
Route::get('/policy', fn () => 'policy')->name('policy');

Route::name('app.')
    ->middleware(['auth', 'verified'])
    ->prefix('/app')
    ->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');
    });
