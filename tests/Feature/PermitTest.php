<?php

namespace Tests\Feature;

use App\Enums\PermitStatus;
use App\Models\Applicant;
use App\Models\Document;
use App\Models\Permit;
use App\Models\Zone;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class PermitTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_permit(): void
    {
        $permit = Permit::factory()->create();

        $this->assertDatabaseHas('permits', [
            'id' => $permit->id,
            'tracking_code' => $permit->tracking_code,
            'applicant_id' => $permit->applicant_id,
            'zone_id' => $permit->zone_id,
            'permit_type' => $permit->permit_type,
        ]);
    }

    public function test_status_casts_to_enum(): void
    {
        $permit = Permit::factory()->create();

        $this->assertInstanceOf(PermitStatus::class, $permit->status);
    }

    public function test_default_status_is_pending(): void
    {
        $applicant = Applicant::factory()->create();
        $zone = Zone::factory()->create();

        $permit = Permit::create([
            'tracking_code' => 'DEFAULT_STATUS_TEST',
            'applicant_id' => $applicant->id,
            'zone_id' => $zone->id,
            'permit_type' => 'Carga/Descarga',
            'request_date' => now()->toDateString(),
            'start_date' => now()->toDateString(),
        ]);
        $permit->refresh();

        $this->assertEquals(PermitStatus::Pending, $permit->status);
    }

    public function test_tracking_code_is_unique(): void
    {
        Permit::factory()->create(['tracking_code' => 'DUPLICATE_TRACKING']);

        $this->expectException(QueryException::class);

        Permit::factory()->create(['tracking_code' => 'DUPLICATE_TRACKING']);
    }

    public function test_belongs_to_applicant(): void
    {
        $applicant = Applicant::factory()->create();
        $permit = Permit::factory()->create(['applicant_id' => $applicant->id]);

        $this->assertInstanceOf(Applicant::class, $permit->applicant);
        $this->assertEquals($applicant->id, $permit->applicant->id);
    }

    public function test_belongs_to_zone(): void
    {
        $zone = Zone::factory()->create();
        $permit = Permit::factory()->create(['zone_id' => $zone->id]);

        $this->assertInstanceOf(Zone::class, $permit->zone);
        $this->assertEquals($zone->id, $permit->zone->id);
    }

    public function test_has_many_documents(): void
    {
        $permit = Permit::factory()->create();
        Document::factory()->count(2)->create(['permit_id' => $permit->id]);

        $this->assertCount(2, $permit->documents);
    }

    public function test_is_paid_casts_to_boolean(): void
    {
        $permit = Permit::factory()->create(['is_paid' => true]);

        $this->assertTrue($permit->is_paid);
        $this->assertIsBool($permit->is_paid);
    }

    public function test_calculated_amount_defaults_to_zero(): void
    {
        $applicant = Applicant::factory()->create();
        $zone = Zone::factory()->create();

        $permit = Permit::create([
            'tracking_code' => 'DEFAULT_AMOUNT_TEST',
            'applicant_id' => $applicant->id,
            'zone_id' => $zone->id,
            'permit_type' => 'Carga/Descarga',
            'request_date' => now()->toDateString(),
            'start_date' => now()->toDateString(),
        ]);
        $permit->refresh();

        $this->assertEquals('0.00', (string) $permit->calculated_amount);
    }

    public function test_request_date_cast_to_date(): void
    {
        $permit = Permit::factory()->create(['request_date' => '2026-08-22']);

        $this->assertInstanceOf(Carbon::class, $permit->request_date);
        $this->assertEquals('2026-08-22', $permit->request_date->toDateString());
    }
}
