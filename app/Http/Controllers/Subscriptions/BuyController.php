<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use LucaLongo\Subscriptions\Models\Plan;

class BuyController extends Controller
{
    public function __invoke(Plan $plan, string $gateway)
    {
        return match ($gateway) {
            // 'stripe' => $this->stripeCheckout($plan),
            // 'paypal' => $this->paypalCheckout($plan),
            // 'paddle' => $this->paddleCheckout($plan),
            default => redirect()
                ->route('app.subscribe')
                ->withErrors(['payment' => __('Payment gateway not supported.') ]),
        };
    }

    protected function createStripePaymentIntent(Plan $plan)
    {
    }
}
