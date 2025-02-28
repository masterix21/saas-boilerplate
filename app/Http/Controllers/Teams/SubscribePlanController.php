<?php

namespace App\Http\Controllers\Teams;

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
            ->groupBy('invoice_interval');

        return view('teams.subscribe-plan', [
            'groupedPlans' => $plans,
        ]);
    }
}
