<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            'Zona 1' => 'Zona 1 — Área central',
            'Zona 2a' => 'Zona 2a — Área norte',
            'Zona 2b' => 'Zona 2b — Área sur',
            'Zona 3' => 'Zona 3 — Área periférica',
        ];

        foreach ($zones as $name => $description) {
            Zone::firstOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }
    }
}
