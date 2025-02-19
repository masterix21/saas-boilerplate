<x-split-layout heading="{{ __('Confirm your password.') }}"
                subheading="{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}">
    <div class="mt-6">
        @session('status')
            <x-alerts.success :title="$value" />
        @endsession

        <form action="{{ route('password.confirm') }}" method="POST" class="space-y-6">
            @csrf

            <flux:field>
                <flux:label>{{ __('Password') }}</flux:label>
                <flux:input type="password"
                            name="password"
                            required
                            autofocus
                            autocomplete="current-password"/>
                <flux:error name="password"/>
            </flux:field>

            <flux:button type="submit" class="w-full" variant="primary">
                {{ __('Confirm') }}
            </flux:button>
        </form>
    </div>
</x-split-layout>
