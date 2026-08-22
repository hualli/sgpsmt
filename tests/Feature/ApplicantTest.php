<?php

namespace Tests\Feature;

use App\Models\Applicant;
use App\Models\Permit;
use App\Models\Zone;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApplicantTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_applicant(): void
    {
        $applicant = Applicant::factory()->create();

        $this->assertDatabaseHas('applicants', [
            'id' => $applicant->id,
            'cuit_cuil' => $applicant->cuit_cuil,
            'name' => $applicant->name,
        ]);
    }

    public function test_cuit_cuil_is_unique(): void
    {
        Applicant::factory()->create(['cuit_cuil' => '30123456789']);

        $this->expectException(QueryException::class);

        Applicant::factory()->create(['cuit_cuil' => '30123456789']);
    }

    public function test_email_and_phone_are_nullable(): void
    {
        $applicant = Applicant::factory()->create([
            'email' => null,
            'phone' => null,
        ]);

        $this->assertDatabaseHas('applicants', [
            'id' => $applicant->id,
            'email' => null,
            'phone' => null,
        ]);
    }

    public function test_has_many_permits(): void
    {
        $applicant = Applicant::factory()->create();
        $zone = Zone::factory()->create();
        Permit::factory()->count(2)->create([
            'applicant_id' => $applicant->id,
            'zone_id' => $zone->id,
        ]);

        $this->assertCount(2, $applicant->permits);
    }
}
