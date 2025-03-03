<?php

namespace App\Payments\Gateways\Stripe\EventHandlers;

use Stripe\Event;

interface StripeEventHandle
{
    public function handle(Event $event): bool;
}
