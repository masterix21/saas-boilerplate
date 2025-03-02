<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use LucaLongo\Subscriptions\Models\Plan;

class BuyController extends Controller
{
    public function __invoke(Plan $plan, string $gateway)
    {
        return match ($gateway) {
            'stripe' => $this->stripeCheckout($plan),
            // 'paypal' => $this->paypalCheckout($plan),
            // 'paddle' => $this->paddleCheckout($plan),
            default => $this->gatewayNotSupportedError(),
        };
    }

    protected function gatewayNotSupportedError(): RedirectResponse
    {
        return redirect()
            ->route('app.subscribe')
            ->withErrors(['payment' => __('Payment gateway not supported.') ]);
    }

    protected function planUnsupportedByGateway(): RedirectResponse
    {
        return redirect()
            ->route('app.subscribe')
            ->withErrors(['payment' => __('Plan not supported by payment gateway.') ]);
    }

    protected function stripeCheckout(Plan $plan)
    {
        if (blank(config('services.stripe.key'))) {
            return $this->gatewayNotSupportedError();
        }

        if (blank($plan->meta['stripe_id'] ?? null)) {
            return $this->planUnsupportedByGateway();
        }
    }
}
