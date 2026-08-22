<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Permit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Document>
 */
class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'permit_id' => Permit::factory(),
            'document_type' => fake()->randomElement(['DNI', 'Habilitacion']),
            'file_path' => 'documents/'.fake()->word().'.pdf',
        ];
    }
}
