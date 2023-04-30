<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'release_year' => 2022,
            'color' => $this->faker->colorName(),
            'price' => $this->faker->numberBetween(10, 100) * 1000000,
            'engine' => $this->faker->word(),
            'seats' => $this->faker->numberBetween(2, 4),
            'type' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(0, 20)
        ];
    }
}
