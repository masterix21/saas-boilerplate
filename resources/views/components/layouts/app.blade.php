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

        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:button variant="ghost" class="w-full text-left flex !justify-start">
                <img src="{{ gravatar(auth()->user()->email)->url() }}" class="h-8 w-8 rounded-full" />

                <p x-text="$store.currentUser.name"></p>
            </flux:button>

            <flux:menu>
                <flux:menu.item href="{{route('profile.show')}}" x-text="$store.currentUser.name" />

                <flux:menu.separator />

                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle">{{ __('Log Out') }}</flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" alignt="start">
            <flux:profile avatar="{{ gravatar(auth()->user()->email)->url() }}" />

            <flux:menu>
                <flux:menu.item href="{{route('profile.show')}}" x-text="$store.currentUser.name" />

                <flux:menu.separator />

                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle">{{ __('Log Out') }}</flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <flux:main>
        {{ $slot }}
    </flux:main>
</x-empty-layout>
