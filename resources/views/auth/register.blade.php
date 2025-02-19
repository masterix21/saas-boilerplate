<x-split-layout heading="{{ __('Register') }}">
    <x-slot:subheading>
        {{ __('Already registered?') }}

        <a href="{{ route('login') }}" class="font-semibold text-primary-link">
            {{ __('Log In') }}
        </a>
    </x-slot:subheading>

    <div class="mt-10">
        @session('status')
            <x-alerts.success :title="$value" />
        @endsession

        <div>
            <form method="POST" action="{{ route('register') }}"  class="space-y-6">
                @csrf

                <flux:field>
                    <flux:label>{{ __('First name') }}</flux:label>
                    <flux:input type="text"
                                name="first_name"
                                :value="old('first_name')"
                                required
                                autofocus
                                autocomplete="given-name" />
                    <flux:error name="first_name" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Last name') }}</flux:label>
                    <flux:input type="text"
                                name="last_name"
                                :value="old('last_name')"
                                required
                                autocomplete="family-name" />
                    <flux:error name="last_name" />
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
