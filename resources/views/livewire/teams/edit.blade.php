<?php

use function Livewire\Volt\{form, mount, state};

form(\App\Livewire\Forms\Teams\TeamEditForm::class);

state('team');

mount(function () {
    $this->form->setTeam($this->team);
});

$save = function () {
    $this->authorize('update', $this->team);

    $this->form->store();
};

?>

<form class="flex flex-col space-y-3"
      method="post"
      wire:submit.prevent="save">
    @csrf

    @session('success')
    <x-alerts.success title="{{ __('Success') }}">{{ $value }}</x-alerts.success>
    @endsession

    @error('message')
    <x-alerts.danger title="{{ __('Error') }}">
        {{ $message }}
    </x-alerts.danger>
    @enderror

    <flux:field>
        <flux:label>{{ __('Name') }}</flux:label>
        @can('update', $team)
            <flux:input wire:model="form.name" autofocus @cannot('update', $team) readonly @endcannot />
        @else
            <p class="pb-1 text-sm text-secondary-600">{{ $team->name }}</p>
        @endcan
        <flux:error name="form.name"/>
    </flux:field>

    <div class="grid sm:grid-cols-2 gap-3">
        <flux:field>
            <flux:label>{{ __('Vat no') }}</flux:label>
            @can('update', $team)
                <flux:input wire:model="form.vat_no"/>
            @else
                <p class="pb-1 text-sm text-secondary-600">{{ $team->vat_no ?: '-' }}</p>
            @endcan
            <flux:error name="form.vat_no"/>
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Tax code') }}</flux:label>
            @can('update', $team)
                <flux:input wire:model="form.tax_code"/>
            @else
                <p class="pb-1 text-sm text-secondary-600">{{ $team->tax_code ?: '-' }}</p>
            @endcan
            <flux:error name="form.tax_code"/>
        </flux:field>
    </div>

    <flux:field>
        <flux:label>{{ __('Billing address') }}</flux:label>
        @can('update', $team)
            <flux:input wire:model="form.street_address1"/>
        @else
            <p class="pb-1 text-sm text-secondary-600">{{ $team->billingAddress->street_address1 }}</p>
            <p class="pb-1 text-sm text-secondary-600">{{ $team->billingAddress->street_address2 }}</p>
        @endcan
        <flux:error name="form.street_address1"/>
    </flux:field>

    @can('update', $team)
        <flux:field>
            <flux:input wire:model="form.street_address2"/>
            <flux:error name="form.street_address2"/>
        </flux:field>
    @endcan

    <div class="grid grid-cols-3 gap-3">
        <flux:field>
            <flux:label>{{ __('Zip') }}</flux:label>
            @can('update', $team)
                <flux:input wire:model="form.zip"/>
            @else
                <p class="pb-1 text-sm text-secondary-600">{{ $team->billingAddress->zip }}</p>
            @endcan
            <flux:error name="form.zip"/>
        </flux:field>

        <flux:field class="col-span-2">
            <flux:label>{{ __('City') }}</flux:label>
            @can('update', $team)
                <flux:input wire:model="form.city"/>
            @else
                <p class="pb-1 text-sm text-secondary-600">{{ $team->billingAddress->city }}</p>
            @endcan
            <flux:error name="form.city"/>
        </flux:field>
    </div>

    <div class="grid sm:grid-cols-3 gap-3">
        <flux:field>
            <flux:label>{{ __('State') }}</flux:label>
            @can('update', $team)
                <flux:input wire:model="form.state"/>
            @else
                <p class="pb-1 text-sm text-secondary-600">{{ $team->billingAddress->state }}</p>
            @endcan
            <flux:error name="form.state"/>
        </flux:field>

        <flux:field class="col-span-2">
            <flux:label>{{ __('Country') }}</flux:label>
            @can('update', $team)
                <flux:input wire:model="form.country"/>
            @else
                <p class="pb-1 text-sm text-secondary-600">{{ $team->billingAddress->country }}</p>
            @endcan
            <flux:error name="form.country"/>
        </flux:field>
    </div>

    @can('update', $team)
        <flux:button type="submit" class="mt-4 w-full cursor-pointer" variant="primary">
            {{ __('Update') }}
        </flux:button>
    @endcan
</form>
