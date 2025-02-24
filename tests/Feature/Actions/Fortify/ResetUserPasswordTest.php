<?php

namespace Tests\Actions\Fortify;

use App\Actions\Fortify\ResetUserPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

test('it resets the user password successfully', function () {
    $user = User::factory()->create();
    $resetAction = new ResetUserPassword();
    $newPassword = 'NewSecurePassword123!';

    $resetAction->reset($user, [
        'password' => $newPassword,
        'password_confirmation' => $newPassword,
    ]);

    expect(Hash::check($newPassword, $user->fresh()->password))->toBeTrue();
});

test('it validates the password format before resetting', function () {
    $user = User::factory()->create();
    $resetAction = new ResetUserPassword();

    Validator::shouldReceive('make')
        ->once()
        ->with(
            ['password' => 'invalid'],
            invade($resetAction)->passwordRules(),
        )
        ->andReturnSelf()
        ->shouldReceive('validate')
        ->once()
        ->andThrow(new \Illuminate\Validation\ValidationException('Validation failed.'));

    $resetAction->reset($user, ['password' => 'invalid']);
})->throws(\Illuminate\Validation\ValidationException::class);
