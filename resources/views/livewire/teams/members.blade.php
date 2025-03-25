<?php

use function Livewire\Volt\{form, mount, state};

form(\App\Livewire\Forms\Teams\AddMemberToTeamForm::class);

state('team');

mount(function () {
    $this->form->team = $this->team?->loadMissing('pendingInvites');
});

$addMember = function () {
    $this->authorize('addMember', $this->team);

    $this->form->store($this->team);

    $this->form->reset();
};

$deleteInvite = function ($inviteId) {
    $pendingInvitation = \App\Models\TeamInvitation::find($inviteId);

    $this->authorize('delete', $pendingInvitation);

    $pendingInvitation->delete();

    Flux::toast(__('The invite has been deleted.'), variant: 'success');
};

$deleteMember = function ($memberId) {
    $teamMember = \App\Models\TeamMember::firstWhere(['member_id' => $memberId, 'team_id' => $this->team->getKey()]);

    $this->authorize('delete', $teamMember);

    $teamMember->delete();

    if ($teamMember->member_id === auth()->id()) {
        if (auth()->user()->current_team_id === $teamMember->team_id) {
            auth()->user()->current_team_id = null;
            auth()->user()->save();
        }

        $this->redirectRoute('app.dashboard');
    }
}
?>

<div>
    <h2 class="text-lg font-bold mb-3">{{ __('Team owner') }}</h2>
    <div class="w-full text-left flex items-center space-x-3 justify-start!">
        <img src="{{ Gravatar::get($team->owner->email) }}" class="h-16 w-16 rounded-full"/>

        <div>
            <p>{{ $team->owner->display_label }}</p>
            <p class="text-xs text-secondary-500">{{ $team->owner->email }}</p>
        </div>
    </div>

    @can('addMember', $team)
        @if ($team->pendingInvites?->isNotEmpty())
            <h2 class="text-lg font-bold mb-3 mt-12">{{ __('Pending invites') }}</h2>
            <ol class="mt-3 flex-col space-y-1">
                @foreach ($team->pendingInvites as $invite)
                    <li class="flex items-center space-x-3">
                        <img src="{{ Gravatar::get($invite->email) }}" class="h-6 w-6 rounded-full"/>
                        <p class="text-sm">{{ $invite->email }}</p>

                        <div class="flex-1">
                            <flux:button icon="trash"
                                         variant="ghost"
                                         size="xs"
                                         color="danger"
                                         class="cursor-pointer"
                                         wire:click="deleteInvite('{{ $invite->getKey() }}')" />
                        </div>
                    </li>
                @endforeach
            </ol>
        @endif
    @endcan

    <h2 class="text-lg font-bold mt-12">{{ __('Team members') }}</h2>
    <ol class="mt-3">
        @can('addMember', $team)
            <li>
                <form wire:submit.prevent="addMember">
                    <flux:field>
                        <flux:input type="text" wire:model="form.email"
                                    placeholder="{{__('Invite a member by email')}}">
                            <x-slot name="iconTrailing">
                                <flux:button type="submit" size="sm" variant="subtle" icon="plus" class="-mr-1"/>
                            </x-slot>
                        </flux:input>
                        <flux:error name="form.email"/>
                    </flux:field>
                </form>
            </li>
        @endcan

        @forelse ($team->members as $member)
            <li class="flex items-center space-x-2">
                <img src="{{ Gravatar::get($member->email) }}" class="h-8 w-8 rounded-full"/>

                <p>{{ $member->display_label }}</p>

                @if ($member->getKey() === auth()->id())
                    <p class="text-success-500 text-xs">{{ __('(YOU)') }}</p>

                    <flux:button icon="arrow-left-start-on-rectangle"
                                 variant="ghost"
                                 size="xs"
                                 color="danger"
                                 class="cursor-pointer"
                                 wire:click="deleteMember('{{ $member->getKey() }}')" />
                @endif
            </li>
        @empty
            <li class="text-secondary-400 dark:text-secondary-700 font-light mt-3 p-3 text-center border dark:border-secondary-800 rounded-xl border-dashed">
                {{ __('There are no members.') }}
            </li>
        @endforelse

    </ol>
</div>
