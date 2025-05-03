<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zone::insert([
            [
                'name' => 'Zona 1',
                'polygon' => 'Polígono Zona 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Zona 2A',
                'polygon' => 'Polígono Zona 2A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Zona 2B',
                'polygon' => 'Polígono Zona 2B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
