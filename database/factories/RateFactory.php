<?php

namespace Database\Factories;

use App\Models\Rate;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rate>
 */
class RateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'zone_id' => Zone::factory(),
            'permit_type' => fake()->randomElement(['Carga/Descarga', 'Contenedor']),
            'max_weight_kg' => fake()->optional()->numberBetween(1000, 30000),
            'street_side' => fake()->randomElement(['right', 'left', 'circulation']),
            'base_price' => fake()->randomFloat(2, 1000, 20000),
        ];
    }
}
