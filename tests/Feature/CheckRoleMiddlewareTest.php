<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_route(): void
    {
        $admin = User::factory()->role('admin')->create();

        $response = $this->actingAs($admin)->get('/admin-panel');

        $response->assertOk();
    }

    public function test_inspector_cannot_access_admin_route(): void
    {
        $inspector = User::factory()->role('inspector')->create();

        $response = $this->actingAs($inspector)->get('/admin-panel');

        $response->assertForbidden();
    }

    public function test_unauthenticated_user_cannot_access_protected_route(): void
    {
        $response = $this->get('/admin-panel');

        $this->assertGuest();
    }

    public function test_user_helper_methods_return_correct_values(): void
    {
        $admin = User::factory()->role('admin')->create();
        $inspector = User::factory()->role('inspector')->create();

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isInspector());

        $this->assertFalse($inspector->isAdmin());
        $this->assertTrue($inspector->isInspector());
    }
}
