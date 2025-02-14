<x-app-layout>
    <flux:heading size="xl" level="1">Dashboard</flux:heading>

    <flux:subheading size="lg" class="mb-6">Good afternoon, {{ auth()->user()->name }}</flux:subheading>

    <flux:separator variant="subtle" />
</x-app-layout>
