<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\Permit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_document(): void
    {
        $document = Document::factory()->create();

        $this->assertDatabaseHas('documents', [
            'id' => $document->id,
            'permit_id' => $document->permit_id,
            'document_type' => $document->document_type,
            'file_path' => $document->file_path,
        ]);
    }

    public function test_belongs_to_permit(): void
    {
        $permit = Permit::factory()->create();
        $document = Document::factory()->create(['permit_id' => $permit->id]);

        $this->assertInstanceOf(Permit::class, $document->permit);
        $this->assertEquals($permit->id, $document->permit->id);
    }
}
