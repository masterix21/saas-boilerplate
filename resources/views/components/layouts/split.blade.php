<x-empty-layout>
    <div class="flex min-h-full">
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                {{ $slot }}
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 size-full object-cover"
                 src="{{ $image ?? asset('/images/backgrounds/auth.webp') }}"
                 alt="">
        </div>
    </div>
</x-empty-layout>
