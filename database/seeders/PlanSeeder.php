<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LucaLongo\Subscriptions\Enums\DurationInterval;
use LucaLongo\Subscriptions\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Basic Plan',
            'description' => 'Your start point',
            'price' => 9.99,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::MONTH,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::MONTH,
        ]);

        Plan::create([
            'name' => 'Premium Plan',
            'description' => 'Your premium point.',
            'price' => 19.99,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::MONTH,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::MONTH,
        ]);

        Plan::create([
            'name' => 'Pro Plan',
            'description' => 'Your pro point.',
            'price' => 29.99,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::MONTH,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::MONTH,
        ]);

        Plan::create([
            'name' => 'Basic Plan',
            'description' => 'Your start point, but paid yearly with 2 months free.',
            'price' => 99,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::YEAR,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::YEAR,
        ]);

        Plan::create([
            'name' => 'Premium Plan',
            'description' => 'Your premium point, but paid yearly with 2 months free.',
            'price' => 190,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::YEAR,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::YEAR,
        ]);

        Plan::create([
            'name' => 'Pro Plan',
            'description' => 'Your pro point, but paid yearly with 2 months free.',
            'price' => 290,
            'duration_period' => 1,
            'duration_interval' => DurationInterval::YEAR,
            'invoice_period' => 1,
            'invoice_interval' => DurationInterval::YEAR,
        ]);
    }
}
