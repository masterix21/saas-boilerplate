<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Payments\Contracts\GatewayContract;
use LucaLongo\Subscriptions\Models\Plan;

class BuyController extends Controller
{
    public function __invoke(Plan $plan, string $gateway, GatewayContract $paymentGateway)
    {
        return $paymentGateway->subscribe(
            auth()->user(),
            $plan,
            route('app.dashboard'),
            route('app.subscribe'),
        );
    }
}
