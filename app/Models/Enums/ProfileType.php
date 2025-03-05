<?php

namespace App\Models\Enums;

use App\Enums\Concerns\ImplementsEnumUtils;

enum ProfileType: string
{
    use ImplementsEnumUtils;

    case COMPANY = 'CMP';
    case MALE = 'MAN';
    case FEMALE = 'FEM';

    public static function values(): array
    {
        return [
            self::COMPANY->value => 'Azienda',
            self::MALE->value => 'Uomo',
            self::FEMALE->value => 'Donna',
        ];
    }
}
