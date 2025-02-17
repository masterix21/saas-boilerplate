@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
        {{ $attributes->wire('then') }}
        x-data
        x-ref="span"
        x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
        x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{ $slot }}
</span>

@once
    <flux:modal name="confirms-password">
        <flux:heading>
            {{ __('Confirm Password') }}
        </flux:heading>

        <flux:subheading>
            {{ __('For your security, please confirm your password to continue.') }}
        </flux:subheading>

        <form method="post" class="mt-8 flex flex-col space-y-6" wire:submit.prevent="confirmPassword">
            <flux:field>
                <flux:label>{{ __('Password') }}</flux:label>

                <flux:input type="password"
                            name="confirmable_password"
                            wire:model="confirmablePassword"
                            required
                            autocomplete="current-password" />
                <flux:error name="confirmable_password"/>
            </flux:field>

            <flux:button type="submit" variant="primary">
                {{ __('Confirm') }}
            </flux:button>
        </form>
    </flux:modal>
@endonce
