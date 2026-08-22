<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

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
