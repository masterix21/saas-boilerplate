<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Masterix21\Addressable\Models\Address;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'addressable_id'   => $this->faker->randomNumber(),
            'addressable_type' => $this->faker->word(),
            'label'            => $this->faker->word(),
            'is_primary'       => $this->faker->boolean(),
            'is_billing'       => $this->faker->boolean(),
            'is_shipping'      => $this->faker->boolean(),
            'street_address1'  => $this->faker->address(),
            'street_address2'  => $this->faker->address(),
            'zip'              => $this->faker->postcode(),
            'city'             => $this->faker->city(),
            'state'            => $this->faker->word(),
            'country'          => $this->faker->countryCode(),
        ];
    }

    public function assignTo(Model $model): self
    {
        return $this->state(fn () => [
            'addressable_type' => $model::class,
            'addressable_id' => $model->getKey(),
        ]);
    }

    public function primary(): self
    {
        return $this->state(fn () => ['is_primary' => true]);
    }

    public function billing(): self
    {
        return $this->state(fn () => ['is_billing' => true]);
    }

    public function shipping(): self
    {
        return $this->state(fn () => ['is_shipping' => true]);
    }
}
