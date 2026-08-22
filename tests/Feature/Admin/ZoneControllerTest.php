<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ZoneControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_accessible_by_admin(): void
    {
        $admin = User::factory()->role('admin')->create();

        $response = $this->actingAs($admin)->get(route('zones.index'));

        $response->assertOk();
    }

    public function test_index_forbidden_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();

        $response = $this->actingAs($inspector)->get(route('zones.index'));

        $response->assertForbidden();
    }

    public function test_index_redirects_guest_to_login(): void
    {
        $response = $this->get(route('zones.index'));

        $response->assertRedirect('login');
    }

    public function test_create_accessible_by_admin(): void
    {
        $admin = User::factory()->role('admin')->create();

        $response = $this->actingAs($admin)->get(route('zones.create'));

        $response->assertOk();
    }

    public function test_store_creates_zone(): void
    {
        $admin = User::factory()->role('admin')->create();

        $response = $this->actingAs($admin)->post(route('zones.store'), [
            'name' => 'Zona de Prueba',
            'description' => 'Descripción de prueba',
        ]);

        $response->assertRedirect(route('zones.index'));
        $this->assertDatabaseHas('zones', [
            'name' => 'Zona de Prueba',
            'description' => 'Descripción de prueba',
        ]);
    }

    public function test_store_forbidden_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();

        $response = $this->actingAs($inspector)->post(route('zones.store'), [
            'name' => 'Zona No Permitida',
        ]);

        $response->assertForbidden();
    }

    public function test_update_updates_zone(): void
    {
        $admin = User::factory()->role('admin')->create();
        $zone = Zone::factory()->create();

        $response = $this->actingAs($admin)->put(route('zones.update', $zone), [
            'name' => 'Zona Actualizada',
            'description' => 'Descripción actualizada',
        ]);

        $response->assertRedirect(route('zones.index'));
        $this->assertDatabaseHas('zones', [
            'id' => $zone->id,
            'name' => 'Zona Actualizada',
        ]);
    }

    public function test_destroy_deletes_zone(): void
    {
        $admin = User::factory()->role('admin')->create();
        $zone = Zone::factory()->create();

        $response = $this->actingAs($admin)->delete(route('zones.destroy', $zone));

        $response->assertRedirect(route('zones.index'));
        $this->assertDatabaseMissing('zones', ['id' => $zone->id]);
    }
}
