<?php

namespace App\Payments\Gateways\Stripe;

use App\Payments\Contracts\WebHookHandlerContract;
use App\Payments\Gateways\Stripe\EventHandlers\CheckoutSessionCompleted;
use App\Payments\Gateways\Stripe\EventHandlers\CustomerSubscriptionDeleted;
use App\Payments\Gateways\Stripe\EventHandlers\CustomerSubscriptionUpdated;
use Illuminate\Http\Request;
use Stripe\Webhook;

class WebHookHandler implements WebHookHandlerContract
{
    public function webHookHandler(Request $request): bool
    {
        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('Stripe-Signature'),
                config('services.stripe.webhook_secret')
            );

            return match ($event->type) {
                'checkout.session.completed' => (new CheckoutSessionCompleted())->handle($event),
                'customer.subscription.deleted' => (new CustomerSubscriptionDeleted())->handle($event),
                'customer.subscription.updated' => (new CustomerSubscriptionUpdated())->handle($event),
                default => true,
            };
        } catch (\Exception $e) {
            return false;
        }
    }
}
