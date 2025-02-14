<x-empty-layout x-data
                style="background-image: url('{{ asset('images/backgrounds/auth.webp') }}'); background-size: cover; background-position: center; background-repeat: no-repeat">
    <div class="w-full h-full flex flex-col items-center justify-center">
        <div class="mx-auto w-5/6 h-5/6 border rounded-lg shadow-md bg-white">


            {{ $slot }}
        </div>
    </div>

    @section('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('currentUser', @js(auth()->user()));
            });
        </script>
    @endsection
</x-empty-layout>
