<x-split-layout heading="{{ __('Forgot your password?') }}">
    <x-slot:subheading>
        <p class="mt-2 text-sm/6 text-subheading">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        <p class="mt-2 text-sm/6 text-subheading">
            {{ __('Not a member?') }}

            <a href="{{  route('register') }}" class="font-semibold text-primary-link">
                {{ __('Register today!') }}
            </a>
        </p>
    </x-slot:subheading>

    <div class="mt-10">
        <div>
            @session('status')
                <x-alerts.success :title="$value" />
            @else
                <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                    @csrf

                    <flux:field>
                        <flux:label>{{ __('E-mail address') }}</flux:label>
                        <flux:input name="email" type="email" required autofocus autocomplete="username" />
                        <flux:error name="email" />
                    </flux:field>

                    <flux:button type="submit" class="w-full" variant="primary">
                        {{ __('Email Password Reset Link') }}
                    </flux:button>
                </form>
            @endsession
        </div>

        <div class="mt-10">
            <flux:separator text="{{ __('Or') }}" />

            <div class="mt-8 flex flex-col gap-4">
                <flux:button href="{{ route('login') }}" class="w-full">
                    {{ __('Sign in') }}
                </flux:button>
            </div>
        </div>
    </div>
</x-split-layout>
