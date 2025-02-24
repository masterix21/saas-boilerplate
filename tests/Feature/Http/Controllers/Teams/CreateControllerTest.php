<?php

namespace Tests\Http\Controllers\Teams;

use App\Models\User;

use function Pest\Laravel\actingAs;

test('show method returns the correct view', function () {
    actingAs(User::factory()->createOne());

    $response = $this->get(route('app.teams.create'));

    $response->assertOk();
});

test('create method fails with missing fields', function () {
    actingAs(User::factory()->createOne());

    $inputData = ['name' => 'New Team'];

    $this->post(route('app.teams.create'), $inputData)
        ->assertInvalid();
});

test('create method uses CreateTeam action with correct parameters', function () {
    $user = User::factory()->createOne();

    actingAs($user);

    $response = $this->post(route('app.teams.create'), [
        'name' => 'New Team',
        'vat_no' => '123456789',
        'billing_address' => [
            'street_address1' => 'street address1',
            'zip' => '12345',
            'city' => 'Rome',
            'state' => 'RM',
            'country' => 'IT',
        ],
    ]);

    $response->assertRedirect(route('app.dashboard'));
});
