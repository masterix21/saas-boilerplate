<x-split-layout heading="{{ __('Authentication code.') }}">
    <div x-data="{ recovery: {{ $errors->has('recovery_code') ? 'true' :'false'}} }">
        <div>
            <p x-show="! recovery" class="mt-2 text-sm/6 text-subheading">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </p>

            <p x-show="recovery" class="mt-2 text-sm/6 text-subheading">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </p>
        </div>

        <div class="mt-6">
            @session('status')
                <x-alerts.success :title="$value" />
            @endsession

            <form action="{{ route('two-factor.login') }}" method="POST" class="space-y-6">
                @csrf

                <template x-if="! recovery">
                    <flux:field>
                        <flux:label>{{ __('Code') }}</flux:label>
                        <flux:input name="code"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="one-time-code"/>
                        <flux:error name="code"/>
                    </flux:field>
                </template>

                <template x-if="recovery">
                    <flux:field>
                        <flux:label>{{ __('Recovery Code') }}</flux:label>
                        <flux:input name="recovery_code"
                                    type="text"
                                    required
                                    autofocus
                                    autocomplete="one-time-code"/>
                        <flux:error name="recovery_code"/>
                    </flux:field>
                </template>

                <a x-show="! recovery" x-on:click="recovery = ! recovery"
                   class="block text-right text-sm cursor-pointer text-primary-link">
                    {{ __('Do you want to use a recovery code?') }}
                </a>

                <a x-show="recovery" x-on:click="recovery = ! recovery"
                   class="block text-right text-sm cursor-pointer text-primary-link">
                    {{ __('Do you want to use an OTP?') }}
                </a>

                <flux:button type="submit" class="w-full" variant="primary">
                    {{ __('Sign in') }}
                </flux:button>
            </form>
        </div>
    </div>
</x-split-layout>
