<?php

namespace Tests\Actions\Fortify;

use App\Actions\Fortify\ResetUserPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

test('it resets the user password successfully', function () {
    $user = User::factory()->create();
    $resetAction = new ResetUserPassword;
    $newPassword = 'NewSecurePassword123!';

    $resetAction->reset($user, [
        'password' => $newPassword,
        'password_confirmation' => $newPassword,
    ]);

    expect(Hash::check($newPassword, $user->fresh()->password))->toBeTrue();
});

test('it validates the password format before resetting', function () {
    $user = User::factory()->create();
    $resetAction = new ResetUserPassword;

    $this->expectException(ValidationException::class);

    $resetAction->reset($user, ['password' => 'invalid']);
});
