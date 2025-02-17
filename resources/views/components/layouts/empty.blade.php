<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://rsms.me">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />

    <!-- Styles / Scripts -->
    @yield('styles')
    @fluxStyles
    @vite(['resources/css/app.css'])
</head>
<body {{ $attributes->merge(['class' => 'font-sans antialiased bg-white h-full w-full']) }}>
    {{ $slot }}

    @vite(['resources/js/app.js'])

    @if (auth()->check())
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('currentUser', @js(auth()->user()));
            });
        </script>

        <flux:modal name="manage-profile"
                    class="!p-0 sm:min-w-[60%] sm:min-h-[60%] flex flex-col"
                    :dismissible="false">
            <x-profile.manage />
        </flux:modal>
    @endif

    @persist('toast')
        <flux:toast />
    @endpersist

    @yield('modals')

    @fluxScripts
    @livewire('wire-elements-modal')

    @yield('scripts')
</body>
</html>
