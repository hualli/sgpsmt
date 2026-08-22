<?php

namespace Tests\Feature\Admin;

use App\Models\Rate;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_forbidden_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();

        $response = $this->actingAs($inspector)->get(route('rates.index'));

        $response->assertForbidden();
    }

    public function test_index_accessible_by_admin(): void
    {
        $admin = User::factory()->role('admin')->create();

        $response = $this->actingAs($admin)->get(route('rates.index'));

        $response->assertOk();
    }

    public function test_index_redirects_guest_to_login(): void
    {
        $response = $this->get(route('rates.index'));

        $response->assertRedirect('login');
    }

    public function test_create_accessible_by_admin(): void
    {
        $admin = User::factory()->role('admin')->create();

        $response = $this->actingAs($admin)->get(route('rates.create'));

        $response->assertOk();
    }

    public function test_store_creates_rate(): void
    {
        $admin = User::factory()->role('admin')->create();
        $zone = Zone::factory()->create();

        $response = $this->actingAs($admin)->post(route('rates.store'), [
            'zone_id' => $zone->id,
            'permit_type' => 'Carga/Descarga',
            'max_weight_kg' => 5000,
            'street_side' => 'right',
            'base_price' => 5000.00,
        ]);

        $response->assertRedirect(route('rates.index'));
        $this->assertDatabaseHas('rates', [
            'zone_id' => $zone->id,
            'permit_type' => 'Carga/Descarga',
            'base_price' => 5000.00,
        ]);
    }

    public function test_store_requires_valid_zone(): void
    {
        $admin = User::factory()->role('admin')->create();

        $response = $this->actingAs($admin)->post(route('rates.store'), [
            'zone_id' => 9999,
            'permit_type' => 'Carga/Descarga',
            'base_price' => 1000.00,
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('zone_id');
    }

    public function test_store_forbidden_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();
        $zone = Zone::factory()->create();

        $response = $this->actingAs($inspector)->post(route('rates.store'), [
            'zone_id' => $zone->id,
            'permit_type' => 'Carga/Descarga',
            'base_price' => 1000.00,
        ]);

        $response->assertForbidden();
    }

    public function test_update_updates_rate(): void
    {
        $admin = User::factory()->role('admin')->create();
        $zone = Zone::factory()->create();
        $rate = Rate::factory()->create(['zone_id' => $zone->id]);

        $response = $this->actingAs($admin)->put(route('rates.update', $rate), [
            'zone_id' => $zone->id,
            'permit_type' => 'Contenedor',
            'max_weight_kg' => 20000,
            'street_side' => 'right',
            'base_price' => 8000.00,
        ]);

        $response->assertRedirect(route('rates.index'));
        $this->assertDatabaseHas('rates', [
            'id' => $rate->id,
            'permit_type' => 'Contenedor',
            'base_price' => 8000.00,
        ]);
    }
}
