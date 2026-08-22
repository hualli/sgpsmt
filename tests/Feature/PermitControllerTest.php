<?php

namespace Tests\Feature;

use App\Enums\PermitStatus;
use App\Models\Permit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermitControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_accessible_by_admin(): void
    {
        $admin = User::factory()->role('admin')->create();

        $response = $this->actingAs($admin)->get(route('permits.index'));

        $response->assertOk();
    }

    public function test_index_accessible_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();

        $response = $this->actingAs($inspector)->get(route('permits.index'));

        $response->assertOk();
    }

    public function test_index_redirects_guest_to_login(): void
    {
        $response = $this->get(route('permits.index'));

        $response->assertRedirect('login');
    }

    public function test_show_accessible_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();
        $permit = Permit::factory()->create();

        $response = $this->actingAs($inspector)->get(route('permits.show', $permit));

        $response->assertOk();
    }

    public function test_show_redirects_guest_to_login(): void
    {
        $permit = Permit::factory()->create();

        $response = $this->get(route('permits.show', $permit));

        $response->assertRedirect('login');
    }

    public function test_update_status_approved_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();
        $permit = Permit::factory()->create();

        $response = $this->actingAs($inspector)->patch(route('permits.status', $permit), [
            'status' => PermitStatus::Approved->value,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('permits', [
            'id' => $permit->id,
            'status' => 'approved',
        ]);
    }

    public function test_update_status_paid_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();
        $permit = Permit::factory()->create(['is_paid' => false]);

        $response = $this->actingAs($inspector)->patch(route('permits.status', $permit), [
            'is_paid' => true,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('permits', [
            'id' => $permit->id,
            'is_paid' => true,
        ]);
    }

    public function test_update_status_rejected_by_inspector(): void
    {
        $inspector = User::factory()->role('inspector')->create();
        $permit = Permit::factory()->create();

        $response = $this->actingAs($inspector)->patch(route('permits.status', $permit), [
            'status' => PermitStatus::Rejected->value,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('permits', [
            'id' => $permit->id,
            'status' => 'rejected',
        ]);
    }

    public function test_update_status_redirects_guest_to_login(): void
    {
        $permit = Permit::factory()->create();

        $response = $this->patch(route('permits.status', $permit), [
            'status' => PermitStatus::Approved->value,
        ]);

        $response->assertRedirect('login');
    }
}
