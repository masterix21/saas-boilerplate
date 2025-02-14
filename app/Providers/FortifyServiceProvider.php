<?php

namespace App\Providers;

use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        app()->singleton(ResetsUserPasswords::class, ResetUserPassword::class);
    }

    public function boot(): void
    {
        $this->bootViews();

        $this->bootRateLimiters();
    }

    protected function bootViews(): void
    {
        Fortify::loginView(fn () => view('auth.login'));
        Fortify::registerView(fn () => view('auth.register'));
        Fortify::verifyEmailView(fn () => view('auth.email'));

        Fortify::requestPasswordResetLinkView(fn () => view('auth.passwords.email'));
        Fortify::resetPasswordView(fn () => view('auth.passwords.reset'));
        Fortify::confirmPasswordView(fn () => view('auth.passwords.confirm'));
    }

    protected function bootRateLimiters(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = str($request->input(Fortify::username()))
                ->append('|')
                ->append($request->ip())
                ->transliterate();

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
