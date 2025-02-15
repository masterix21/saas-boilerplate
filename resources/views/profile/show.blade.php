<x-profile-layout>
    <div class="flex flex-col divide-y lg:divide-y-0 lg:grid lg:grid-cols-8 lg:divide-x h-full">
        <div class="lg:col-span-2 p-6 flex lg:flex-col items-center space-x-6 lg:space-x-0 lg:space-y-6">
            <img src="{{ gravatar(auth()->user()->email)->url() }}" class="h-24 w-24 rounded-md" />

            <div class="flex flex-col">
                <p class="text-xl lg:text-lg xl:text-xl 2xl:text-2xl font-semibold" x-text="$store.currentUser.name"></p>
            </div>
        </div>
        <div class="flex-1 lg:col-span-6 p-3">
            AAAAAA
        </div>
    </div>
</x-profile-layout>
