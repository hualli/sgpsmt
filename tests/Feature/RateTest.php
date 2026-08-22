<?php

namespace Tests\Feature;

use App\Models\Rate;
use App\Models\Zone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_rate(): void
    {
        $rate = Rate::factory()->create();

        $this->assertDatabaseHas('rates', [
            'id' => $rate->id,
            'zone_id' => $rate->zone_id,
            'permit_type' => $rate->permit_type,
            'base_price' => $rate->base_price,
        ]);
    }

    public function test_belongs_to_zone(): void
    {
        $zone = Zone::factory()->create();
        $rate = Rate::factory()->create(['zone_id' => $zone->id]);

        $this->assertInstanceOf(Zone::class, $rate->zone);
        $this->assertEquals($zone->id, $rate->zone->id);
    }

    public function test_base_price_cast_decimal(): void
    {
        $rate = Rate::factory()->create(['base_price' => 7500.00]);

        $this->assertEquals('7500.00', (string) $rate->base_price);
    }

    public function test_max_weight_kg_cast_integer(): void
    {
        $rate = Rate::factory()->create(['max_weight_kg' => 15000]);

        $this->assertEquals(15000, $rate->max_weight_kg);
        $this->assertIsInt($rate->max_weight_kg);
    }
}
