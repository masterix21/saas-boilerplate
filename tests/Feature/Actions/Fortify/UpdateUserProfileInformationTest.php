<?php

namespace Tests\Actions\Fortify;

use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

test('it successfully updates the user profile when data is valid', function () {
    $user = User::factory()->create();
    $action = new UpdateUserProfileInformation;

    $action->update($user, [
        'first_name' => 'New',
        'last_name' => 'Name',
        'email' => 'newemail@example.com',
    ]);

    $user->refresh();

    expect($user->first_name)->toBe('New');
    expect($user->last_name)->toBe('Name');
    expect($user->email)->toBe('newemail@example.com');
});

test('it throws validation exception when data is invalid', function () {
    $user = User::factory()->create();
    $action = new UpdateUserProfileInformation;

    $this->expectException(ValidationException::class);

    $action->update($user, [
        'first_name' => '',
        'last_name' => '',
        'email' => 'invalid-email',
    ]);
});

test('it does not reset email verification status when email remains the same for verified user', function () {
    Notification::fake();

    $user = User::factory()->create(['email_verified_at' => now()]);
    $action = new UpdateUserProfileInformation;

    $action->update($user, [
        'first_name' => 'New',
        'last_name' => 'Name',
        'email' => $user->email,
    ]);

    $user->refresh();

    expect($user->email_verified_at)->not()->toBeNull();
    Notification::assertNothingSent();
});
