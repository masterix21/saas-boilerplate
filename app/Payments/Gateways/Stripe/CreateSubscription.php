<?php

namespace App\Payments\Gateways\Stripe;

use App\Models\Team;
use App\Models\User;
use App\Payments\Contracts\CreateSubscriptionContract;
use App\Payments\Exceptions\PaymentGatewayUnsupportedByPlan;
use App\Payments\Gateways\StripeGateway;
use Illuminate\Http\RedirectResponse;
use LucaLongo\Subscriptions\Models\Plan;

class CreateSubscription implements CreateSubscriptionContract
{
    public function subscribe(
        User $user,
        Plan $plan,
        string $successUrl,
        string $cancelUrl,
        array $options = []
    ): RedirectResponse {
        if (! ($plan->meta['stripe_id'] ?? null)) {
            throw new PaymentGatewayUnsupportedByPlan($plan->name .' does not support Stripe');
        }

        $customer = app(Customer::class)->customerFindOrNew($user);

        return redirect()->away(
            app(StripeGateway::class)->client()->checkout->sessions->create([
                'mode' => 'subscription',
                'customer' => $customer->id,
                'line_items' => [
                    [
                        'price' => $plan->meta['stripe_id'],
                        'quantity' => 1,
                    ],
                ],
                'metadata' => [
                    'team_id' => auth()->user()->current_team_id,
                    'plan_id' => $plan->getKey(),
                ],
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
            ])->url
        );
    }
}
