<x-empty-layout x-data>
    <flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <x-logo />

        <flux:navlist variant="outline" class="pt-3 lg:pt-6">
            <flux:navlist.item icon="home"
                               href="{{ route('app.dashboard') }}"
                               :current="request()->routeIs('app.dashboard')">
                {{ __('Dashboard') }}
            </flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
        </flux:navlist>

        <flux:modal.trigger name="manage-profile">
            <flux:button variant="ghost" class="w-full text-left flex justify-start!">
                <img src="{{ Gravatar::get(auth()->user()->email) }}" class="h-8 w-8 rounded-full" />

                <p x-text="$store.currentUser.display_label"></p>
            </flux:button>
        </flux:modal.trigger>
    </flux:sidebar>

    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:modal.trigger name="manage-profile">
            <flux:profile avatar="{{ Gravatar::get(auth()->user()->email) }}" chevron="" />
        </flux:modal.trigger>
    </flux:header>

    <flux:main>
        {{ $slot }}
    </flux:main>
</x-empty-layout>
