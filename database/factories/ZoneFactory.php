<?php

namespace Database\Factories;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Zone>
 */
class ZoneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Zona '.fake()->numberBetween(1, 5),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
