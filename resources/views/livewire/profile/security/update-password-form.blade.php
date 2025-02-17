<?php

use function Livewire\Volt\{state};

new class extends \Livewire\Volt\Component {
    public array $state = [
        'current_password'      => '',
        'password'              => '',
        'password_confirmation' => '',
    ];

    public function submit(): void
    {
        (new \App\Actions\Fortify\UpdateUserPassword())
            ->update(
                user: auth()->user(),
                input: $this->state,
            );
    }
}

?>
<div>
    <flux:heading size="lg">
        {{ __('Update Password') }}
    </flux:heading>

    <flux:subheading class="mb-6">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </flux:subheading>

    <form method="post" wire:submit.prevent="submit">
        <div class="grid lg:grid-cols-2 lg:column-off gap-6 mb-6">
            <flux:field>
                <flux:label>{{ __('Current password') }}</flux:label>
                <flux:input type="password"
                            name="current_password"
                            wire:model="state.current_password"
                            required
                            autocomplete="current-password" />
                <flux:error name="current_password"/>
            </flux:field>

            <flux:field class="col-start-1">
                <flux:label>{{ __('New password') }}</flux:label>
                <flux:input type="password"
                            name="password"
                            wire:model="state.password"
                            required
                            autocomplete="new-password"/>
                <flux:error name="password"/>
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Confirm password') }}</flux:label>
                <flux:input type="password"
                            name="password_confirmation"
                            wire:model="state.password_confirmation"
                            required
                            autocomplete="new-password"/>
                <flux:error name="password_confirmation"/>
            </flux:field>
        </div>

        <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
    </form>
</div>
