<x-split-layout>
    <div>
        <div>
            <x-logo />

            <h2 class="mt-8 text-2xl/9 font-bold tracking-tight text-secondary-900">
                {{ __('Verify Email Address') }}
            </h2>

            <p class="mt-2 text-sm/6 text-secondary-500">
                {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </div>

        <div class="mt-6">
            @if (session('status') === 'verification-link-sent')
                <x-alerts.success title="{!! __('A new verification link has been sent to the email address you provided in your profile settings.') !!}" />
            @endif

            <form action="{{ route('verification.send') }}" method="POST" class="space-y-6">
                @csrf

                <flux:button type="submit" class="w-full" variant="primary">
                    {{ __('Resend Verification Email') }}
                </flux:button>
            </form>
        </div>

        <div class="my-10">
            <flux:separator text="{{ __('Or') }}" />
        </div>

        <form method="post" action="{{ route('logout') }}">
            @csrf

            <flux:button type="submit" class="w-full">
                {{ __('Log Out') }}
            </flux:button>
        </form>
    </div>
</x-split-layout>
