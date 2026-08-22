<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Rate;
use App\Models\Zone;
use Database\Seeders\ZoneSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZoneTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_zone(): void
    {
        $zone = Zone::factory()->create();

        $this->assertDatabaseHas('zones', [
            'id' => $zone->id,
            'name' => $zone->name,
        ]);
    }

    public function test_factory_creates_zone_with_description(): void
    {
        $zone = Zone::factory()->create(['description' => 'Test zone description']);

        $this->assertDatabaseHas('zones', [
            'name' => $zone->name,
            'description' => 'Test zone description',
        ]);
    }

    public function test_zones_seeded_correctly(): void
    {
        $this->seed(ZoneSeeder::class);

        $this->assertDatabaseCount('zones', 4);
        $this->assertDatabaseHas('zones', ['name' => 'Zona 1']);
        $this->assertDatabaseHas('zones', ['name' => 'Zona 2a']);
        $this->assertDatabaseHas('zones', ['name' => 'Zona 2b']);
        $this->assertDatabaseHas('zones', ['name' => 'Zona 3']);
    }

    public function test_has_many_rates(): void
    {
        $zone = Zone::factory()->create();
        Rate::factory()->count(3)->create(['zone_id' => $zone->id]);

        $this->assertCount(3, $zone->rates);
    }

    public function test_has_many_permits(): void
    {
        $zone = Zone::factory()->create();
        $applicant = Applicant::factory()->create();
        $zone->permits()->create([
            'applicant_id' => $applicant->id,
            'tracking_code' => 'TRK_ZONE_TEST_1',
            'permit_type' => 'Carga/Descarga',
            'request_date' => now()->toDateString(),
            'start_date' => now()->toDateString(),
        ]);

        $this->assertCount(1, $zone->permits);
    }
}
