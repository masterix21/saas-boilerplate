<?php

namespace Tests\Actions\Fortify;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('password is updated successfully when valid current and new password are provided', function () {
    $user = User::factory()->create([
        'password' => Hash::make('current-password'),
    ]);

    $action = new UpdateUserPassword();

    $action->update($user, [
        'current_password'      => 'current-password',
        'password'              => 'new-StrongPassword123',
        'password_confirmation' => 'new-StrongPassword123',
    ]);

    expect(Hash::check('new-StrongPassword123', $user->fresh()->password))->toBeTrue();
});

test('validation fails when current password is incorrect', function () {
    $user = User::factory()->create([
        'password' => Hash::make('current-password'),
    ]);

    $action = new UpdateUserPassword();

    $this->expectExceptionMessage(__('The provided password does not match your current password.'));

    $action->update($user, [
        'current_password'      => 'wrong-password',
        'password'              => 'new-StrongPassword123',
        'password_confirmation' => 'new-StrongPassword123',
    ]);
});

test('validation fails when new password does not follow rules', function () {
    $user = User::factory()->create([
        'password' => Hash::make('current-password'),
    ]);

    $action = new UpdateUserPassword();

    $this->expectException(\Illuminate\Validation\ValidationException::class);

    $action->update($user, [
        'current_password'      => 'current-password',
        'password'              => 'short',
        'password_confirmation' => 'short',
    ]);
});

test('validation fails when password confirmation does not match', function () {
    $user = User::factory()->create([
        'password' => Hash::make('current-password'),
    ]);

    $action = new UpdateUserPassword();

    $this->expectException(\Illuminate\Validation\ValidationException::class);

    $action->update($user, [
        'current_password'      => 'current-password',
        'password'              => 'new-StrongPassword123',
        'password_confirmation' => 'differentPassword123',
    ]);
});
