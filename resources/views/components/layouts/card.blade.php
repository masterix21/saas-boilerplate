@extends('components.layouts.default')

@section('body')
    <div class="h-full flex flex-col items-center justify-center">
        <div class="rounded-md border border-gray-200 shadow p-4 min-w-xs">
            {{ $slot }}
        </div>
    </div>
@endsection
