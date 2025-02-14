@props([
    'title' => '',
    'description' => '',
    'dismissible' => false,
])
<template x-data="{'dismissed': false }" x-if="! dismissed">
    <div class="rounded-md bg-success-50 border border-success-200 shadow p-4">
        <div class="flex">
            <div class="shrink-0">
                <svg class="size-5 text-success-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-success-800">{{ $title }}</h3>
                @if ($slot)
                    <div class="mt-2 text-sm text-success-700">{{ $slot }}</div>
                @endif

                @if ($dismissible)
                    <div class="mt-4">
                        <div class="-mx-2 -my-1.5 flex">
                            <button type="button"
                                    x-on:click="dismissed = true"
                                    class="ml-3 rounded-md bg-success-50 px-2 py-1.5 text-sm font-medium text-success-800 hover:bg-success-100 focus:outline-none focus:ring-2 focus:ring-success-600 focus:ring-offset-2 focus:ring-offset-success-50">
                                {{ __('Dismiss') }}
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</template>
