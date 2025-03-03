<?php

namespace App\Payments\Contracts;

use Illuminate\Http\Request;

interface WebHookHandlerContract
{
    public function webHookHandler(Request $request): bool;
}
