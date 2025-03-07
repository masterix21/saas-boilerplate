<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\AddressFactory;
use Illuminate\Database\Seeder;
use LucaLongo\Subscriptions\Actions\CreateSubscription;
use LucaLongo\Subscriptions\Models\Plan;

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

        if (app()->environment('production')) {
            return;
        }

        $this->call([
            PlanSeeder::class,
        ]);

        tap(User::factory(1)->createOne(), function (User $user) {
            /** @var Team $team */
            $team = Team::factory(1)->ownedBy($user)->createOne();

            $user->currentTeam()->associate($team)->save();

            AddressFactory::new()
                ->assignTo($team)
                ->primary()
                ->billing()
                ->createOne();

            $team->subscribe(Plan::first());
        });

        tap(User::factory(1)->createOne(), function (User $user) {
            /** @var Team $team */
            $team = Team::factory(1)->ownedBy($user)->createOne();

            $user->currentTeam()->associate($team)->save();

            AddressFactory::new()
                ->assignTo($team)
                ->primary()
                ->billing()
                ->createOne();
        });

        User::factory(3)->create();
    }
}
