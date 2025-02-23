@props([
    'title' => '',
    'dismissible' => false,
])
<template x-data="{'dismissed': false }" x-if="! dismissed">
    <div class="rounded-md bg-danger-50 border border-danger-200 shadow-sm p-4">
        <div class="flex">
            <div class="shrink-0">
                <flux:icon name="x-circle" variant="solid" class="size-5 text-danger-400" />
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-danger-800">{{ $title }}</h3>
                @if ($slot)
                    <div class="mt-2 text-sm text-danger-700">{{ $slot }}</div>
                @endif

                @if ($dismissible)
                    <div class="mt-4">
                        <div class="-mx-2 -my-1.5 flex">
                            <button type="button"
                                    x-on:click="dismissed = true"
                                    class="ml-3 rounded-md bg-danger-50 px-2 py-1.5 text-sm font-medium text-danger-800 hover:bg-danger-100 focus:outline-hidden focus:ring-2 focus:ring-danger-600 focus:ring-offset-2 focus:ring-offset-danger-50">
                                {{ __('Dismiss') }}
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</template>
