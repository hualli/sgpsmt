<?php

namespace Database\Factories;

use App\Enums\PermitStatus;
use App\Models\Applicant;
use App\Models\Permit;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Permit>
 */
class PermitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tracking_code' => Str::random(12),
            'applicant_id' => Applicant::factory(),
            'zone_id' => Zone::factory(),
            'permit_type' => fake()->randomElement(['Carga/Descarga', 'Contenedor']),
            'request_date' => fake()->date(),
            'start_date' => fake()->date(),
            'end_date' => fake()->optional()->date(),
            'vehicle_weight_kg' => fake()->optional()->numberBetween(500, 50000),
            'license_plate' => fake()->optional()->regexify('[A-Z]{3}[0-9]{3}'),
            'street_side' => fake()->optional()->randomElement(['right', 'left', 'circulation']),
            'operations_count' => fake()->numberBetween(1, 10),
            'calculated_amount' => fake()->randomFloat(2, 0, 50000),
            'status' => fake()->randomElement(PermitStatus::cases()),
            'is_paid' => fake()->boolean(),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}
