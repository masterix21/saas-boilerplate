<?php

use Flux\Flux;
use function Livewire\Volt\{state};

new class extends \Livewire\Volt\Component
{
    public array $data = [];

    public function mount(): void
    {
        $this->data = [
            'first_name' => auth()->user()->first_name,
            'last_name' => auth()->user()->last_name,
            'email' => auth()->user()->email,
        ];
    }

    public function submit(): void
    {
        (new \App\Actions\Fortify\UpdateUserProfileInformation())
            ->update(
                user: auth()->user(),
                input: $this->data,
            );

        $this->dispatch('saved', ['currentUser' => auth()->user()->toArray()]);

        Flux::toast(__('Successfully saved.'), variant: 'success', position: 'top right');
    }
}

?>

<form method="post" wire:submit.prevent="submit">
    <div class="grid lg:grid-cols-2 gap-6 mb-6">
        <flux:field>
            <flux:label>{{ __('First name') }}</flux:label>
            <flux:input type="text"
                        name="first_name"
                        wire:model="data.first_name"
                        required
                        autocomplete="given-name" />
            <flux:error name="first_name" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Last name') }}</flux:label>
            <flux:input type="text"
                        name="last_name"
                        wire:model="data.last_name"
                        required
                        autocomplete="family-name" />
            <flux:error name="last_name" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('E-mail') }}</flux:label>
            <flux:input type="email"
                        name="email"
                        wire:model="data.email"
                        required
                        autocomplete="email" />
            <flux:error name="email" />
        </flux:field>
    </div>

    <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
</form>

@script
    <script>
        $wire.on('saved', function (data) {
            let currentUser = Object.assign($store.currentUser, {
                first_name: data[0].currentUser.first_name,
                last_name: data[0].currentUser.last_name,
                display_label: data[0].currentUser.display_label,
                email: data[0].currentUser.email,
            });

            Alpine.store('currentUser' , currentUser);
        });
    </script>
@endscript
