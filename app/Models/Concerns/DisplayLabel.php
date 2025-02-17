<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

interface DisplayLabel
{
    public function displayLabel(): Attribute;
}
