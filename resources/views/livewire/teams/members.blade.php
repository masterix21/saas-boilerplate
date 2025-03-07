<?php

use function Livewire\Volt\{state};



state('team');

$addMember = function () {

};
?>

<div>
    <h2 class="text-lg font-bold mb-3">{{ __('Team owner') }}</h2>
    <div class="w-full text-left flex items-center space-x-3 justify-start!">
        <img src="{{ Gravatar::get($team->owner->email) }}" class="h-8 w-8 rounded-full" />

        <p>{{ $team->owner->display_label }}</p>
    </div>

    <h2 class="text-lg font-bold mt-12">{{ __('Team members') }}</h2>
    <ol class="mt-3">
        <li>
           <form wire:submit.prevent="addMember">
               <flux:input type="text" wire:model="addMemberForm.email" placeholder="{{__('Invite a member by email')}}">
                   <x-slot name="iconTrailing">
                       <flux:button size="sm" variant="subtle" icon="plus" class="-mr-1" />
                   </x-slot>
               </flux:input>
           </form>
        </li>
        @forelse ($team->members as $member)
            <li class="flex items-center">
                <img src="{{ Gravatar::get($user->email) }}" class="h-8 w-8 rounded-full" />
                <p>{{ $user->display_label }}</p>

                <div class="flex-1">

                </div>
            </li>
        @empty
            <li class="text-secondary-400 dark:text-secondary-700 font-light mt-3 p-3 text-center border dark:border-secondary-800 rounded-xl border-dashed">
                {{ __('There are no members.') }}
            </li>
        @endforelse

    </ol>
</div>
