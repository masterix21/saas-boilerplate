<x-split-layout>
    <div>
        <x-logo />

        <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-secondary-900">{{ __('Sign in to your account') }}</h2>
        <p class="mt-2 text-sm/6 text-secondary-500">
            {{ __('Not a member?') }}

            <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-500">{{ __('Register today!') }}</a>
        </p>
    </div>

    <div class="mt-10">
        @session('status')
            <x-alerts.success :title="$value" />
        @endsession
        <div>
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <flux:field>
                    <flux:label>{{ __('E-mail address') }}</flux:label>
                    <flux:input name="email"
                                type="email"
                                :value="old('email')"
                                required
                                autofocus
                                autocomplete="username" />
                    <flux:error name="email" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Password') }}</flux:label>
                    <flux:input name="password" type="password" required autocomplete="password" />
                    <flux:error name="password" />
                </flux:field>

                <div class="flex items-center justify-between">
                    <flux:checkbox wire:model="terms" :label="__('Remember me')" />

                    <div class="text-sm/6">
                        <a href="{{ route('password.request') }}"
                           class="font-semibold text-primary-600 hover:text-primary-500">
                            {{__('Forgot password?') }}
                        </a>
                    </div>
                </div>

                <flux:button type="submit" class="w-full" variant="primary">
                    {{ __('Sign in') }}
                </flux:button>
            </form>
        </div>

        <x-auth.social />

        @env('local')
            <div class="mt-10">
                <flux:separator text="{{ __('Local environment only') }}" />

                <div class="mt-6 flex flex-col gap-4">
                    <x-login-link class="border rounded-sm px-3 py-1.5 w-full text-danger-500 cursor-pointer" email="l.longo@ambita.it" label="Luca Longo (cowboy)" />

                    <x-login-link class="border rounded-sm px-3 py-1.5 w-full text-danger-500 cursor-pointer" email="m.rossi@example.org" label="Mario Rossi (normal user)" />
                </div>
            </div>
        @endenv
    </div>
</x-split-layout>
