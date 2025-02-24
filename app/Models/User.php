<?php

namespace App\Models;

use App\Models\Concerns\DisplayLabel;
use App\Models\Concerns\HasPersonalTeam;
use App\Models\Concerns\HasTeams;
use App\Models\Concerns\TeamMate;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use LucaLongo\Subscriptions\Models\Concerns\HasSubscriptions;

class User extends Authenticatable implements
    // HasPersonalTeam,
    DisplayLabel, FilamentUser, HasName, MustVerifyEmail, TeamMate
{
    use HasFactory;
    use HasSubscriptions;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'language',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'two_factor_confirmed_at',
    ];

    protected $appends = [
        'display_label',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function displayLabel(): Attribute
    {
        return Attribute::get(fn () => str($this->first_name)
            ->append(' ')
            ->append($this->last_name)
            ->squish()
        );
    }

    public function getFilamentName(): string
    {
        return $this->display_label;
    }

    public function isCowBoy(): bool
    {
        return str($this->email)->endsWith('@ambita.it');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isCowBoy();
    }
}
