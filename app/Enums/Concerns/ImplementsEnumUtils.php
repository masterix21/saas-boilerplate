<?php

namespace App\Enums\Concerns;

use Illuminate\Support\Arr;

trait ImplementsEnumUtils
{
    public function is($value): bool
    {
        if (! $value instanceof static) {
            $value = static::tryFrom($value);
        }

        return $this === $value;
    }

    public function isNot($value): bool
    {
        return ! $this->is($value);
    }

    public static function parse($value): static
    {
        if ($value instanceof static) {
            return $value;
        }

        return static::tryFrom($value);
    }

    public static function toArray(): array
    {
        return Arr::mapWithKeys(static::cases(), fn ($value) => [$value->value => $value->label()]);
    }
}
