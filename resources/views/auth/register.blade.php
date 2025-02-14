<x-split-layout>
    <div>
        <x-logo />

        <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-secondary-900">{{ __('Register') }}</h2>
        <p class="mt-2 text-sm/6 text-secondary-500">
            {{ __('Already registered?') }}

            <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-500">{{ __('Log In') }}</a>
        </p>
    </div>

    <div class="mt-10">
        @session('status')
            <x-alerts.success :title="$value" />
        @endsession

        <div>
            <form method="POST" action="{{ route('register') }}"  class="space-y-6">
                @csrf

                <flux:field>
                    <flux:label>{{ __('Name') }}</flux:label>
                    <flux:input type="text"
                                name="name"
                                :value="old('name')"
                                required
                                autofocus
                                autocomplete="name" />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('E-mail') }}</flux:label>
                    <flux:input type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autocomplete="email" />
                    <flux:error name="email" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Password') }}</flux:label>
                    <flux:input type="password"
                                name="password"
                                required
                                autocomplete="new-password" />
                    <flux:error name="password" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Confirm Password') }}</flux:label>
                    <flux:input type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password" />
                    <flux:error name="password_confirmation" />
                </flux:field>

                <flux:field>
                    <flux:checkbox name="terms" label="{{ __('I agree to the terms and conditions') }}" />

                    <flux:error name="terms" />
                </flux:field>

                <flux:button type="submit" class="w-full" variant="primary">
                    {{ __('Register') }}
                </flux:button>
            </form>
        </div>

        <x-auth.social />
    </div>
</x-split-layout>
