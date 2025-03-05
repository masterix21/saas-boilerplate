<?php

namespace App\Models;

use App\Actions\Teams\InviteUser;
use App\Models\Concerns\DisplayLabel;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LucaLongo\Subscriptions\Models\Concerns\HasSubscriptions;
use LucaLongo\Subscriptions\Models\Contracts\SubscriberContract;
use Masterix21\Addressable\Models\Concerns\HasAddresses;
use Masterix21\Addressable\Models\Concerns\HasBillingAddresses;
use Masterix21\Addressable\Models\Concerns\HasShippingAddresses;

class Team extends Model implements DisplayLabel, SubscriberContract
{
    use HasAddresses;
    use HasBillingAddresses;
    use HasFactory;
    use HasShippingAddresses;
    use HasSubscriptions;

    protected $fillable = [
        'name',
        'vat_no',
        'tax_code',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'meta' => AsarrayObject::class,
        ];
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'team_members', 'team_id', 'member_id')
            ->using(TeamMember::class);
    }

    public function invite(User $user): bool
    {
        return (new InviteUser)->invite($this, $user);
    }

    public function displayLabel(): Attribute
    {
        return Attribute::get(fn () => $this->name);
    }

    public function customerName(): string
    {
        return $this->name;
    }

    public function customerEmail(): string
    {
        return $this->owner->email;
    }

    public function customerUniqueIdentifierKey(): string
    {
        return $this->getForeignKey();
    }

    public function customerUniqueIdentifier(): string
    {
        return $this->getKey();
    }
}
