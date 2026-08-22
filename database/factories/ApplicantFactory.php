<?php

namespace Database\Factories;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Applicant>
 */
class ApplicantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cuit_cuil' => fake()->unique()->numerify('###########'),
            'name' => fake()->name(),
            'email' => fake()->optional()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
        ];
    }
}
