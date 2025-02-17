<?php

namespace App\Livewire\Concerns;

use Flux\Flux;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\ConfirmPassword;
use Livewire\Component;

/** @mixin Component */
trait HasConfirmsPassword
{
    public ?string $confirmableId = null;
    public string $confirmablePassword = '';

    /**
     * Start confirming the user's password.
     */
    public function startConfirmingPassword(string $confirmableId): void
    {
        $this->resetErrorBag();

        if ($this->passwordIsConfirmed()) {
            $this->dispatch('password-confirmed',
                id: $confirmableId,
            );

            return;
        }

        $this->confirmableId = $confirmableId;
        $this->confirmablePassword = '';

        Flux::modal('confirms-password')->show();
    }

    /**
     * Stop confirming the user's password.
     */
    public function stopConfirmingPassword(): void
    {
        $this->confirmableId = null;
        $this->confirmablePassword = '';

        Flux::modal('confirms-password')->close();
    }

    /**
     * Confirm the user's password.
     */
    public function confirmPassword(): void
    {
        if (! app(ConfirmPassword::class)(app(StatefulGuard::class), auth()->user(), $this->confirmablePassword)) {
            throw ValidationException::withMessages([
                'confirmable_password' => [__('This password does not match our records.')],
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->dispatch('password-confirmed',
            id: $this->confirmableId,
        );

        $this->stopConfirmingPassword();
    }

    /**
     * Ensure that the user's password has been recently confirmed.
     */
    protected function ensurePasswordIsConfirmed(?int $maximumSecondsSinceConfirmation = null): void
    {
        $maximumSecondsSinceConfirmation = $maximumSecondsSinceConfirmation ?: config('auth.password_timeout', 900);

        $this->passwordIsConfirmed($maximumSecondsSinceConfirmation) ? null : abort(403);
    }

    /**
     * Determine if the user's password has been recently confirmed.
     */
    protected function passwordIsConfirmed(?int $maximumSecondsSinceConfirmation = null): bool
    {
        $maximumSecondsSinceConfirmation = $maximumSecondsSinceConfirmation ?: config('auth.password_timeout', 900);

        return (time() - session('auth.password_confirmed_at', 0)) < $maximumSecondsSinceConfirmation;
    }
}
