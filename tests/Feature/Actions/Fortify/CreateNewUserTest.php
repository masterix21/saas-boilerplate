<?php

namespace Tests\Actions\Fortify;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it creates a user with valid input', function () {
    $action = new CreateNewUser;

    $input = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
        'password' => 'StrongPassword123!',
        'password_confirmation' => 'StrongPassword123!',
    ];

    $user = $action->create($input);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->first_name)->toBe($input['first_name'])
        ->and($user->last_name)->toBe($input['last_name'])
        ->and($user->email)->toBe($input['email']);
});

test('it fails if the email is already taken', function () {
    User::factory()->create(['email' => 'john.doe@example.com']);

    $action = new CreateNewUser;

    $input = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
        'password' => 'StrongPassword123!',
        'password_confirmation' => 'StrongPassword123!',
    ];

    $action->create($input);
})->throws('Illuminate\Validation\ValidationException');

test('it fails if the password does not meet requirements', function () {
    $action = new CreateNewUser;

    $input = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
        'password' => 'short',
        'password_confirmation' => 'short',
    ];

    $action->create($input);
})->throws('Illuminate\Validation\ValidationException');

test('it fails if required fields are missing', function () {
    $action = new CreateNewUser;

    $input = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    $action->create($input);
})->throws('Illuminate\Validation\ValidationException');
