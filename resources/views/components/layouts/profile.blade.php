<x-empty-layout x-data
                style="background-image: url('{{ asset('images/backgrounds/auth.webp') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="mx-auto max-w-7xl sm:p-6 lg:p-8 flex flex-col items-center justify-center h-full">
        <div class="flex-1 bg-white sm:rounded-lg sm:shadow-xl w-full overflow-hidden">
            <div class="flex flex-col divide-y lg:divide-y-0 lg:grid lg:grid-cols-8 lg:divide-x h-full">
                <div class="lg:col-span-2 flex lg:flex-col items-center space-x-6 lg:space-x-0 lg:space-y-6">
                    <div class="p-3 border-b w-full">
                        <flux:button href="/" icon="arrow-left" variant="ghost">
                            {{ __('Back to app') }}
                        </flux:button>
                    </div>

                    <img src="{{ gravatar(auth()->user()->email)->url() }}" class="h-24 w-24 rounded-md" />

                    <div class="flex flex-col">
                        <p class="text-xl lg:text-lg xl:text-xl 2xl:text-2xl font-semibold" x-text="$store.currentUser.name"></p>
                    </div>
                </div>
                <div class="flex-1 lg:col-span-6 p-3">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-empty-layout>
