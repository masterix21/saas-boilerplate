<x-split-layout>
    <div>
        <x-logo />

        <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-secondary-900">{{ __('Forgot your password?') }}</h2>
        <p class="mt-2 text-sm/6 text-secondary-500">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>
        <p class="mt-2 text-sm/6 text-secondary-500">
            {{ __('Not a member?') }}

            <a href="{{  route('register') }}" class="font-semibold text-primary-600 hover:text-primary-500">{{ __('Register today!') }}</a>
        </p>
    </div>

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
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm/6 font-medium">
                        <span class="bg-white px-6 text-gray-900">
                            {{ __('Or') }}
                        </span>
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-4">
                <flux:button href="{{ route('login') }}" class="w-full">
                    {{ __('Sign in') }}
                </flux:button>
            </div>
        </div>
    </div>
</x-split-layout>
