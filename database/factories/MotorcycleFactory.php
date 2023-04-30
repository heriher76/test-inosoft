<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;

class MotorcycleFactory extends Factory
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
            'suspension' => $this->faker->word(),
            'transmission' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(0, 20)
        ];
    }
}
