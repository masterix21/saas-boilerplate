<?php

namespace App\Payments\Contracts;

use App\Models\User;

interface CustomerContract
{

    public function customerFindOrNew(User $user): mixed;
}
