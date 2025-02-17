<?php

use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use function Livewire\Volt\{state};

new class extends \Livewire\Volt\Component {
    use \App\Livewire\Concerns\HasConfirmsPassword;

    public bool $showingQrCode = false;
    public bool $showingConfirmation = false;
    public bool $showingRecoveryCodes = false;

    public string $code = '';

    public function mount(): void
    {
    }

    #[\Livewire\Attributes\Computed]
    public function enabled(): bool
    {
        return filled(auth()->user()->two_factor_secret);
    }

    public function enableTwoFactorAuthentication(EnableTwoFactorAuthentication $enable): void
    {
        $this->ensurePasswordIsConfirmed();

        $enable(Auth::user());

        $this->showingQrCode = true;
        $this->showingConfirmation = true;
        // $this->showingRecoveryCodes = true;
    }

    public function disableTwoFactorAuthentication(DisableTwoFactorAuthentication $disable): void
    {
        $this->ensurePasswordIsConfirmed();

        $disable(Auth::user());

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = false;
    }

    public function confirmTwoFactorAuthentication(ConfirmTwoFactorAuthentication $confirm): void
    {
        $this->ensurePasswordIsConfirmed();

        $confirm(Auth::user(), $this->code);

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = true;
    }

    public function showRecoveryCodes(): void
    {
        $this->ensurePasswordIsConfirmed();

        $this->showingRecoveryCodes = true;
    }

    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generate): void
    {
        $this->ensurePasswordIsConfirmed();

        $generate(Auth::user());

        $this->showingRecoveryCodes = true;
    }
}

?>
<div>
    <flux:heading size="lg">
        {{ __('Two Factor Authentication') }}
    </flux:heading>

    <flux:subheading>
        {{ __('Add additional security to your account using two factor authentication.') }}
    </flux:subheading>

    <div class="mt-3 mb-6 text-sm text-secondary-600 dark:text-secondary-200">
        <p>
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>
    </div>

    @if ($this->enabled)
        @if ($showingQrCode)
            <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                <p class="font-semibold">
                    @if ($showingConfirmation)
                        {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                    @else
                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                    @endif
                </p>
            </div>

            <div class="mt-4 p-2 inline-block bg-white">
                {!! auth()->user()->twoFactorQrCodeSvg() !!}
            </div>

            <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                <p class="font-semibold">
                    {{ __('Setup Key') }}: {{ decrypt(auth()->user()->two_factor_secret) }}
                </p>
            </div>

            @if ($showingConfirmation)
                <flux:field class="mb-6">
                    <flux:label>{{ __('Code') }}</flux:label>

                    <flux:input type="text"
                                name="code"
                                wire:model="code"
                                wire:keydown.enter="confirmTwoFactorAuthentication"
                                inputmode="numeric"
                                autofocus
                                required
                                autocomplete="one-time-code"/>

                    <flux:error name="code"/>
                </flux:field>
            @endif
        @endif

        @if ($showingRecoveryCodes)
            <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                <p class="font-semibold">
                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                </p>
            </div>

            <div class="grid gap-1 max-w-xl mt-4 mb-8 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-gray-900 dark:text-gray-100 rounded-lg">
                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                    <div>{{ $code }}</div>
                @endforeach
            </div>
        @endif
    @endif

    <div>
        @if (! $this->enabled)
            <x-auth.confirms-password wire:then="enableTwoFactorAuthentication">
                <flux:button>
                    {{ __('Enable') }}
                </flux:button>
            </x-auth.confirms-password>
        @else
            @if ($showingRecoveryCodes)
                <x-auth.confirms-password wire:then="regenerateRecoveryCodes">
                    <flux:button>
                        {{ __('Regenerate Recovery Codes') }}
                    </flux:button>
                </x-auth.confirms-password>
            @elseif ($showingConfirmation)
                <x-auth.confirms-password wire:then="confirmTwoFactorAuthentication">
                    <flux:button variant="primary" type="button" class="me-3" wire:loading.attr="disabled">
                        {{ __('Confirm') }}
                    </flux:button>
                </x-auth.confirms-password>
            @else
                <x-auth.confirms-password wire:then="showRecoveryCodes">
                    <flux:button class="me-3">
                        {{ __('Show Recovery Codes') }}
                    </flux:button>
                </x-auth.confirms-password>
            @endif

            @if ($showingConfirmation)
                <x-auth.confirms-password wire:then="disableTwoFactorAuthentication">
                    <flux:button wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </flux:button>
                </x-auth.confirms-password>
            @else
                <x-auth.confirms-password wire:then="disableTwoFactorAuthentication">
                    <flux:button variant="danger" wire:loading.attr="disabled">
                        {{ __('Disable') }}
                    </flux:button>
                </x-auth.confirms-password>
            @endif
        @endif
    </div>
</div>
