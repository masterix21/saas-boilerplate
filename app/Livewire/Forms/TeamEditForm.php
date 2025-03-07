<?php

namespace App\Livewire\Forms;

use App\Models\Team;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TeamEditForm extends Form
{
    public ?Team $team;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';

    #[Validate(['nullable', 'required_without:tax_code', 'string', 'max:255'])]
    public string $vat_no = '';

    #[Validate(['nullable', 'required_without:vat_no', 'string', 'max:255'])]
    public string $tax_code = '';

    #[Validate(['required', 'string', 'max:255'], as: 'address')]
    public string $street_address1 = '';

    #[Validate(['nullable', 'string', 'max:255'], as: 'address')]
    public string $street_address2 = '';

    #[Validate(['required', 'string', 'max:255'], as: 'zip')]
    public string $zip = '';

    #[Validate(['required', 'string', 'max:255'], as: 'city')]
    public string $city = '';

    #[Validate(['required', 'string', 'max:255'], as: 'state')]
    public string $state = '';

    #[Validate(['required', 'string', 'max:4'], as: 'country')]
    public string $country = '';

    public function setTeam(Team $team): void
    {
        $this->team = $team->loadMissing(['billingAddress']);

        $this->name = $team->name;
        $this->vat_no = $team->vat_no;
        $this->tax_code = $team->tax_code;
        $this->street_address1 = $team->billingAddress->street_address1 ?? '';
        $this->street_address2 = $team->billingAddress->street_address2 ?? '';
        $this->zip = $team->billingAddress->zip ?? '';
        $this->city = $team->billingAddress->city ?? '';
        $this->state = $team->billingAddress->state ?? '';
        $this->country = $team->billingAddress->country ?? '';
    }

    public function store(): void
    {
        $this->validate();

        $this->team->update(
            $this->only('name', 'vat_no', 'tax_code')
        );

        $this->team->billingAddress->update(
            $this->only('street_address1', 'street_address2', 'zip', 'city', 'state', 'country')
        );

        session()->flash('success', __('Team updated successfully.'));
    }
}
