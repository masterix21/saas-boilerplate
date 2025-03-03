<?php

namespace App\Providers;

use App\Payments\Contracts\GatewayContract;
use App\Payments\Gateways\StripeGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(GatewayContract::class, fn () => new StripeGateway());
        $this->app->alias(GatewayContract::class, 'paymentGateway');
    }
}
