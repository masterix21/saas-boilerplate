<div class="flex-1 flex flex-col divide-y lg:divide-y-0 lg:grid lg:grid-cols-8 lg:divide-x h-full">
    <div class="lg:col-span-2 flex lg:flex-col items-center space-x-6 lg:space-x-0 lg:space-y-6 py-6 lg:py-12 px-6 overflow-hidden">
        <img src="{{ gravatar(auth()->user()->email)->url() }}" class="h-24 w-24 rounded-md" />

        <div class="flex flex-col lg:justify-center lg:items-center">
            <p class="text-lg font-semibold" x-text="$store.currentUser.display_label"></p>
            <p class="text-sm text-secondary-500" x-text="$store.currentUser.email"></p>

            <form method="post" action="{{ route('logout') }}" class="lg:hidden mt-1.5 -ml-1">
                @csrf
                <button type="submit" class="flex items-center space-x-1.5 group text-xs text-secondary-500 hover:text-danger-500">
                    <flux:icon.arrow-right-start-on-rectangle />

                    <span >{{ __('Log Out') }}</span>
                </button>
            </form>
        </div>

        <div class="hidden lg:flex lg:flex-1"></div>

        <form method="post" action="{{ route('logout') }}" class="hidden lg:block">
            @csrf
            <flux:menu.item type="submit" class="flex space-x-1.5 group text-xs">
                <flux:icon.arrow-right-start-on-rectangle class="text-secondary-500  group-hover:text-danger-500" />

                <span class="text-secondary-500 group-hover:text-danger-500">{{ __('Log Out') }}</span>
            </flux:menu.item>
        </form>
    </div>
    <div class="flex-1 lg:col-span-6 pt-6">
        <flux:tab.group>
            <flux:tabs class="pr-16">
                <flux:tab name="profile" icon="user" class="px-6 pb-6">{{ __('Profile') }}</flux:tab>
                <flux:tab name="billing" icon="banknotes" class="px-6 pb-6">{{ __('Billing') }}</flux:tab>
                <flux:tab name="security" icon="key" class="px-6 pb-6">{{ __('Security') }}</flux:tab>
            </flux:tabs>

            <flux:tab.panel name="profile" class="p-6">
                <livewire:profile.edit-form />
            </flux:tab.panel>

            <flux:tab.panel name="billing" class="p-6">
                Billing
            </flux:tab.panel>

            <flux:tab.panel name="security" class="p-6">
                <livewire:profile.security.update-password-form />

                <flux:separator class="my-8" />

                <livewire:profile.security.two-factor-authentication-form />
            </flux:tab.panel>
        </flux:tab.group>

        {{ $slot }}
    </div>
</div>
