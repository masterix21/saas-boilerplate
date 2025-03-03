<?php

namespace App\Payments\Contracts;

interface GatewayContract
{
    public function client(): mixed;
}

