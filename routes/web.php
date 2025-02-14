<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/terms', fn () => 'terms')->name('terms');
Route::get('/policy', fn () => 'policy')->name('policy');
