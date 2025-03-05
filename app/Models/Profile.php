<?php

namespace App\Models;

use App\Models\Concerns\DisplayLabel;
use App\Models\Concerns\TeamAware;
use App\Models\Enums\ProfileType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use LucaLongo\LaravelContacts\Models\Concerns\HasContacts;
use Masterix21\Addressable\Models\Concerns\HasAddresses;
use Masterix21\Addressable\Models\Concerns\HasBillingAddresses;
use Masterix21\Addressable\Models\Concerns\HasShippingAddresses;

class Profile extends Model implements DisplayLabel
{
    use HasAddresses;
    use HasBillingAddresses;
    use HasContacts;
    use HasFactory;
    use HasShippingAddresses;
    use TeamAware;

    protected $fillable = [
        'is_supplier',
        'is_customer',
        'type',
        'name',
        'first_name',
        'last_name',
        'vat_no',
        'tax_code',
        'birth_date',
        'birth_country',
        'birth_city',
        'phone',
        'email',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'is_supplier' => 'bool',
            'is_customer' => 'bool',
            'type' => ProfileType::class,
            'birth_date' => 'date',
        ];
    }

    public function displayLabel(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type === ProfileType::COMPANY) {
                return $this->name;
            }

            return str($this->first_name)
                ->append(' ')
                ->append($this->last_name)
                ->squish();
        });
    }
}
