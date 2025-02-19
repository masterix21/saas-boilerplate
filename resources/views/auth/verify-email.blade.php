<x-split-layout heading="{{ __('Verify Email Address') }}"
                subheading="{{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}">

    <div>
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
