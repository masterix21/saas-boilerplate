<?php

namespace App\Actions\Teams;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateTeam
{
    public function create(array $input, User $user): Team
    {
        Validator::make(
            data: $input,
            rules: [
                'name' => ['required', 'string', 'max:255'],
                'vat_no' => ['required_without:tax_code', 'nullable', 'string', 'max:255'],
                'tax_code' => ['required_without:vat_no', 'nullable', 'string', 'max:255'],
                'billing_address.street_address1' => ['required', 'string', 'max:255'],
                'billing_address.street_address2' => ['nullable', 'string', 'max:255'],
                'billing_address.zip' => ['required', 'string', 'max:255'],
                'billing_address.city' => ['required', 'string', 'max:255'],
                'billing_address.state' => ['required', 'string', 'max:255'],
                'billing_address.country' => ['required', 'string', 'max:4'],
            ],
            attributes: [
                'vat_no' => __('vat no'),
                'tax_code' => __('tax code'),
                'billing_address.street_address1' => __('address'),
                'billing_address.zip' => __('zip'),
                'billing_address.city' => __('city'),
                'billing_address.state' => __('state'),
                'billing_address.country' => __('country'),
            ],
        )->validate();

        DB::beginTransaction();

        try {
            $team = (new Team)->fill(Arr::except($input, ['billing_address']));
            $team->owner_id = $user->getKey();
            $team->save();

            $team->billingAddress()->create($input['billing_address']);

            $user->current_team_id = $team->getKey();
            $user->save();

            DB::commit();

            return $team;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
