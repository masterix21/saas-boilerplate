<?php

namespace App\Http\Controllers\Hooks\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Stripe\Webhook;

class StripeController extends Controller
{
    protected StripeClient $stripe;

    public function __invoke(Request $request): bool
    {
        return app('paymentGateway')->webHookHandler($request);
    }
}
