<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'vat_no' => $this->faker->word(),
            'tax_code' => $this->faker->word(),
            'owner_id' => null,
        ];
    }

    public function ownedBy($user): self
    {
        return $this->state(fn () => ['owner_id' => $user->id]);
    }
}
