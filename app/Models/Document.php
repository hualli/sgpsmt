<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $permit_id
 * @property string $document_type
 * @property string $file_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\DocumentFactory factory($count = null, $state = [])
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo permit()
 */
class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'permit_id',
        'document_type',
        'file_path',
    ];

    public function permit(): BelongsTo
    {
        return $this->belongsTo(Permit::class);
    }
}
