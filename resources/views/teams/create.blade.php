<x-split-layout heading="{{ __('Create your Team') }}"
                subheading="{{ __('Create a new team to collaborate with others.') }}">

    <form class="mt-10 flex flex-col space-y-3" method="post" action="{{ route('app.teams.create') }}">
        @csrf

        <flux:field>
            <flux:label>{{ __('Name') }}</flux:label>
            <flux:input name="name" autofocus value="{{ old('name') }}" />
            <flux:error name="name" />
        </flux:field>

        <div class="grid sm:grid-cols-2 gap-3">
            <flux:field>
                <flux:label>{{ __('Vat no') }}</flux:label>
                <flux:input name="vat_no" value="{{ old('vat_no') }}" />
                <flux:error name="vat_no" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Tax code') }}</flux:label>
                <flux:input name="tax_code" value="{{ old('tax_code') }}" />
                <flux:error name="tax_code" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label>{{ __('Billing address') }}</flux:label>
            <flux:input name="billing_address[street_address1]" value="{{ old('billing_address.street_address1') }}" />
            <flux:error name="billing_address.street_address1" />
        </flux:field>

        <flux:input name="billing_address[street_address2]" value="{{ old('billing_address.street_address2') }}" />

        <div class="grid grid-cols-3 gap-3">
            <flux:field>
                <flux:label>{{ __('Zip') }}</flux:label>
                <flux:input name="billing_address[zip]" value="{{ old('billing_address.zip') }}" />
                <flux:error name="billing_address.zip" />
            </flux:field>

            <flux:field class="col-span-2">
                <flux:label>{{ __('City') }}</flux:label>
                <flux:input name="billing_address[city]" value="{{ old('billing_address.city') }}" />
                <flux:error name="billing_address.city" />
            </flux:field>
        </div>

        <div class="grid sm:grid-cols-3 gap-3">
            <flux:field>
                <flux:label>{{ __('State') }}</flux:label>
                <flux:input name="billing_address[state]" value="{{ old('billing_address.state') }}" />
                <flux:error name="billing_address.state" />
            </flux:field>

            <flux:field class="col-span-2">
                <flux:label>{{ __('Country') }}</flux:label>
                <flux:input name="billing_address[country]" value="{{ old('billing_address.country') }}" />
                <flux:error name="billing_address.country" />
            </flux:field>
        </div>

        <flux:button type="submit" class="mt-4 w-full cursor-pointer" variant="primary">
            {{ __('Create') }}
        </flux:button>
    </form>
</x-split-layout>
