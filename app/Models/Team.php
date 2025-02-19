<?php

namespace App\Models;

use App\Actions\Teams\InviteUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use LucaLongo\Subscriptions\Models\Concerns\HasSubscriptions;
use Masterix21\Addressable\Models\Concerns\HasAddresses;
use Masterix21\Addressable\Models\Concerns\HasBillingAddresses;
use Masterix21\Addressable\Models\Concerns\HasShippingAddresses;

class Team extends Model
{
    use HasAddresses;
    use HasBillingAddresses;
    use HasShippingAddresses;
    use HasSubscriptions;

    protected $fillable = [
        'name',
        'vat_no',
        'tax_code',
    ];

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
}
