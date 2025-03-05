<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use LucaLongo\Subscriptions\Models\Plan;

class SubscribePlanController extends Controller
{
    public function index()
    {
        $plans = Plan::query()
            ->with('features')
            ->active()
            ->visible()
            ->get()
            ->sortBy('name')
            ->groupBy('duration_interval');

        return view('subscriptions.buy', [
            'groupedPlans' => $plans,
            'gateways' => str(config('saas.payment_gateway'))->explode(','),
        ]);
    }
}
