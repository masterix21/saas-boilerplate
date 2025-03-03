<?php

namespace App\Payments\Contracts;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use LucaLongo\Subscriptions\Models\Plan;

interface CreateSubscriptionContract
{
    public function subscribe(
        User $user,
        Plan $plan,
        string $successUrl,
        string $cancelUrl,
        array $options = []
    ): RedirectResponse;
}
