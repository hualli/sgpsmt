<?php

namespace Database\Seeders;

use App\Models\Rate;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    public function run(): void
    {
        $zones = Zone::all()->keyBy('name');

        $rates = [
            ['Zona 1', 'Carga/Descarga', 5000, 'right', 5000.00],
            ['Zona 1', 'Contenedor', 20000, 'right', 10000.00],
            ['Zona 2a', 'Carga/Descarga', 5000, 'right', 4000.00],
            ['Zona 2a', 'Contenedor', 20000, 'right', 8000.00],
            ['Zona 2b', 'Carga/Descarga', 3000, 'left', 3500.00],
            ['Zona 3', 'Carga/Descarga', 3000, 'circulation', 3000.00],
        ];

        foreach ($rates as [$zoneName, $permitType, $maxWeight, $streetSide, $basePrice]) {
            Rate::firstOrCreate(
                [
                    'zone_id' => $zones[$zoneName]->id,
                    'permit_type' => $permitType,
                    'street_side' => $streetSide,
                ],
                [
                    'max_weight_kg' => $maxWeight,
                    'base_price' => $basePrice,
                ]
            );
        }
    }
}
