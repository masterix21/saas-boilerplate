<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use LucaLongo\Subscriptions\Models\Plan;
use LucaLongo\Subscriptions\Payments\Contracts\GatewayContract;

class BuyController extends Controller
{
    public function __invoke(Plan $plan, string $gateway, GatewayContract $paymentGateway)
    {
        return $paymentGateway->subscribe(
            $plan,
            auth()->user()->currentTeam,
            route('app.dashboard'),
            route('app.subscribe'),
        );
    }
}
