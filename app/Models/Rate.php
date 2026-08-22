<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $zone_id
 * @property string $permit_type
 * @property int|null $max_weight_kg
 * @property string|null $street_side
 * @property string|float $base_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\RateFactory factory($count = null, $state = [])
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo zone()
 */
class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'permit_type',
        'max_weight_kg',
        'street_side',
        'base_price',
    ];

    protected function casts(): array
    {
        return [
            'max_weight_kg' => 'integer',
            'base_price' => 'decimal:2',
        ];
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }
}
