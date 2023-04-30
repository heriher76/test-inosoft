<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Car;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purchase_date' => now()->toDateString(),
            'buyer_name' => $this->faker->name(),
            'unit' => $this->faker->randomDigit(),
            'vehicle_id' => 1,
            'type' => 'car'
        ];
    }
}
