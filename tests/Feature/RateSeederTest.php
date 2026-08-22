<?php

namespace Tests\Feature;

use App\Models\Rate;
use App\Models\Zone;
use Database\Seeders\RateSeeder;
use Database\Seeders\ZoneSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_rates_seeded_after_zones(): void
    {
        $this->seed([ZoneSeeder::class, RateSeeder::class]);

        $this->assertDatabaseCount('rates', 6);
    }

    public function test_rate_values_correct(): void
    {
        $this->seed([ZoneSeeder::class, RateSeeder::class]);

        $zone1 = Zone::where('name', 'Zona 1')->first();

        $this->assertDatabaseHas('rates', [
            'zone_id' => $zone1->id,
            'permit_type' => 'Contenedor',
            'street_side' => 'right',
            'base_price' => 10000.00,
            'max_weight_kg' => 20000,
        ]);

        $zone3 = Zone::where('name', 'Zona 3')->first();

        $this->assertDatabaseHas('rates', [
            'zone_id' => $zone3->id,
            'permit_type' => 'Carga/Descarga',
            'street_side' => 'circulation',
            'base_price' => 3000.00,
            'max_weight_kg' => 3000,
        ]);
    }

    public function test_rates_belong_to_seeded_zones(): void
    {
        $this->seed([ZoneSeeder::class, RateSeeder::class]);

        $zone1 = Zone::where('name', 'Zona 1')->first();
        $rates = Rate::where('zone_id', $zone1->id)->get();

        foreach ($rates as $rate) {
            $this->assertInstanceOf(Zone::class, $rate->zone);
        }
    }
}
