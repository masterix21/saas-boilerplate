<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LucaLongo\Subscriptions\Enums\DurationInterval;
use LucaLongo\Subscriptions\Models\Feature;
use LucaLongo\Subscriptions\Models\Plan;

class PlanSeeder extends Seeder
{
    protected Feature $users;
    protected Feature $profiles;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->users = Feature::create(['name' => 'Users']);
        $this->profiles = Feature::create(['name' => 'Profiles']);

        $this->createBasicPlan();

        $this->createPremiumPlan();

        $this->createProPlan();
    }

    protected function createBasicPlan(): void
    {
        Plan::create([
            'name' => 'Basic Plan',
            'description' => 'Your start point',
            'price' => 9.99,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::MONTH,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::MONTH,
            'meta' => [
                'stripe_id' => 'price_1Qya6zR2GIf3wtN5DueRB6sW',
            ],
        ])->features()->attach([
            $this->users->id => ['max_usage' => 5],
            $this->profiles->id => ['max_usage' => 250]
        ]);

        Plan::create([
            'name' => 'Basic Plan',
            'description' => 'Your start point, but paid yearly with 2 months free.',
            'price' => 99,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::YEAR,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::YEAR,
            'meta' => [
                'stripe_id' => 'price_1Qya6zR2GIf3wtN5sDJAEbg1',
            ]
        ])->features()->attach([
            $this->users->id => ['max_usage' => 5],
            $this->profiles->id => ['max_usage' => 250]
        ]);
    }

    protected function createPremiumPlan(): void
    {
        Plan::create([
            'name' => 'Premium Plan',
            'description' => 'Your premium point.',
            'price' => 19.99,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::MONTH,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::MONTH,
        ])->features()->attach([
            $this->users->id => ['max_usage' => 5],
            $this->profiles->id => ['max_usage' => 500]
        ]);

        Plan::create([
            'name' => 'Premium Plan',
            'description' => 'Your premium point, but paid yearly with 2 months free.',
            'price' => 190,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::YEAR,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::YEAR,
        ])->features()->attach([
            $this->users->id => ['max_usage' => 5],
            $this->profiles->id => ['max_usage' => 500]
        ]);
    }

    protected function createProPlan(): void
    {
        Plan::create([
            'name' => 'Pro Plan',
            'description' => 'Your pro point.',
            'price' => 29.99,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::MONTH,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::MONTH,
        ])->features()->attach([
            $this->users->id => ['max_usage' => 10],
            $this->profiles->id => ['max_usage' => 10000]
        ]);

        Plan::create([
            'name' => 'Pro Plan',
            'description' => 'Your pro point, but paid yearly with 2 months free.',
            'price' => 290,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::YEAR,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::YEAR,
        ])->features()->attach([
            $this->users->id => ['max_usage' => 10],
            $this->profiles->id => ['max_usage' => 10000]
        ]);
    }
}
