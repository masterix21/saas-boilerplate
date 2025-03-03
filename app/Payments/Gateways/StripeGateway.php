<?php

namespace App\Payments\Gateways;

use App\Models\User;
use App\Payments\Contracts\CreateSubscriptionContract;
use App\Payments\Contracts\CustomerContract;
use App\Payments\Contracts\GatewayContract;
use App\Payments\Contracts\WebHookHandlerContract;
use App\Payments\Gateways\Stripe\CreateSubscription;
use App\Payments\Gateways\Stripe\Customer;
use App\Payments\Gateways\Stripe\WebHookHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LucaLongo\Subscriptions\Models\Plan;
use Stripe\StripeClient;

class StripeGateway implements
    GatewayContract,
    CustomerContract,
    CreateSubscriptionContract,
    WebHookHandlerContract
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * @return StripeClient
     */
    public function client(): mixed
    {
        return $this->stripe;
    }

    public function subscribe(User $user, Plan $plan, string $successUrl, string $cancelUrl, array $options = []): RedirectResponse
    {
        return app(CreateSubscription::class)->subscribe($user, $plan, $successUrl, $cancelUrl, $options);
    }

    public function customerFindOrNew(User $user): mixed
    {
        return app(Customer::class)->customerFindOrNew($user);
    }

    public function webHookHandler(Request $request): bool
    {
        return app(WebHookHandler::class)->webHookHandler($request);
    }
}
