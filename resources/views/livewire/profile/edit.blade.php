<?php

use function Livewire\Volt\{state};

new class extends \Livewire\Volt\Component
{
    public array $data = [];

    public function mount(): void
    {
        $this->data = [
            'name' => auth()->user()->name,
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

        $this->dispatch('saved', ['currentUser' => $this->data]);
    }
}

?>

<form method="post" wire:submit.prevent="submit">
    <div class="grid lg:grid-cols-2 gap-6 mb-6">
        <flux:field>
            <flux:label>{{ __('Name') }}</flux:label>
            <flux:input type="text"
                        name="name"
                        wire:model="data.name"
                        required
                        autofocus
                        autocomplete="name" />
            <flux:error name="name" />
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
            Alpine.store('currentUser').name = data[0].currentUser.name;
            Alpine.store('currentUser').email = data[0].currentUser.email;
        });
    </script>
@endscript
