<x-split-layout heading="{{ __('Change your password') }}">
    <div class="mt-10">
        <div>
            @session('status')
                <x-alerts.success :title="$value" />
            @else
                <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <flux:field>
                        <flux:label>{{ __('E-mail address') }}</flux:label>
                        <flux:input type="email"
                                    name="email"
                                    :value="old('email', request()->email)"
                                    required
                                    autofocus
                                    autocomplete="username" />
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

                    <flux:button type="submit" class="w-full" variant="primary">
                        {{ __('Reset Password') }}
                    </flux:button>
                </form>
            @endsession
        </div>
    </div>
</x-split-layout>
