<?php

use function Livewire\Volt\{state};

state('team');

?>

<div>
    <h2 class="text-lg font-bold">{{ __('Team owner') }}</h2>
    <p>{{ $team->owner->display_label }}</p>

    <h2 class="text-lg font-bold mt-8">{{ __('Team members') }}</h2>
    <ol class="mt-1.5">
        <li>
           <form wire:submit.prevent="addMember">
               <flux:input type="text" wire:model="addMemberForm.email" placeholder="{{__('Add new member by email')}}">
                   <x-slot name="iconTrailing">
                       <flux:button size="sm" variant="subtle" icon="plus" class="-mr-1" />
                   </x-slot>
               </flux:input>
           </form>
        </li>
        @forelse ($team->members as $member)
            <li>{{ $user->display_label }}</li>
        @empty
            <li class="text-secondary-400">{{ __('There are no members.') }}</li>
        @endforelse

    </ol>
</div>
