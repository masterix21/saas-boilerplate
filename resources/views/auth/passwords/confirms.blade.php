<x-split-layout>
    <div>
        <x-logo />

        <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-secondary-900">
            {{ __('Confirm your password.') }}
        </h2>

        <p class="mt-2 text-sm/6 text-secondary-500">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>
    </div>

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
