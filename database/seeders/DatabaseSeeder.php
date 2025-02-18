<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Luca',
            'last_name' => 'Longo',
            'email' => 'l.longo@ambita.it',
            'password' => bcrypt('lucaluca'),
            'email_verified_at' => now(),
            'language' => 'it',
        ]);

        User::create([
            'first_name' => 'Mario',
            'last_name' => 'Rossi',
            'email' => 'm.rossi@example.org',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'language' => 'it',
        ]);
    }
}
