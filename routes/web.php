<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/app')->middleware('auth');

Route::get('/terms', fn () => 'terms')->name('terms');
Route::get('/policy', fn () => 'policy')->name('policy');

Route::group(['middleware' => ['auth', 'verified'], 'name' => 'app.', 'prefix' => '/app'], function () {
    Route::view('/', 'dashboard')->name('dashboard');
});
