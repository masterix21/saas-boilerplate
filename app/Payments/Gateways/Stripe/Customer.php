<?php

namespace App\Payments\Gateways\Stripe;

use App\Models\User;
use App\Payments\Contracts\CustomerContract;
use App\Payments\Gateways\StripeGateway;

class Customer implements CustomerContract
{
    public function __construct(protected StripeGateway $gateway)
    {
        // ...
    }

    /**
     * @param  User  $user
     *
     * @return \Stripe\Customer
     */
    public function customerFindOrNew(User $user): mixed
    {
        return $this->findByCustomerId($user)
            ?: $this->findByEmail($user)
            ?: $this->create($user);
    }

    protected function evaluateCustomer(?\Stripe\Customer $customer): ?\Stripe\Customer
    {
        if (! $customer?->isDeleted()) {
            return $customer;
        }

        return null;
    }

    protected function findByCustomerId(User $user): ?\Stripe\Customer
    {
        $customerId = $user->meta['stripe_id'] ?? null;

        if (blank($customerId)) {
            return null;
        }

        return $this->evaluateCustomer(
            rescue(fn () => $this->gateway->client()->customers->retrieve($customerId), report: false)
        );
    }

    protected function findByEmail(User $user): ?\Stripe\Customer
    {
        return $this->evaluateCustomer(
            rescue(fn () => $this->gateway->client()->customers->search([
                'query' => "email:'$user->email'"
            ])->first(), report: false)
        );
    }

    protected function create(User $user): \Stripe\Customer
    {
        /** @var \Stripe\Customer $customer */
        $customer = $this->gateway->client()->customers->create([
            'name' => $user->display_label,
            'email' => $user->email,
        ]);

        $user->meta ??= [];
        $user->meta['stripe_id'] = $customer->id;
        $user->save();

        return $customer;
    }
}
