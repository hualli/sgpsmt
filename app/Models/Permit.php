<?php

namespace App\Models;

use App\Enums\PermitStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $tracking_code
 * @property int $applicant_id
 * @property int $zone_id
 * @property string $permit_type
 * @property string $request_date
 * @property string $start_date
 * @property string|null $end_date
 * @property int|null $vehicle_weight_kg
 * @property string|null $license_plate
 * @property string|null $street_side
 * @property int $operations_count
 * @property string|float $calculated_amount
 * @property PermitStatus $status
 * @property bool $is_paid
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\PermitFactory factory($count = null, $state = [])
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo applicant()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo zone()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany documents()
 */
class Permit extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'applicant_id',
        'zone_id',
        'permit_type',
        'request_date',
        'start_date',
        'end_date',
        'vehicle_weight_kg',
        'license_plate',
        'street_side',
        'operations_count',
        'calculated_amount',
        'status',
        'is_paid',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'request_date' => 'date',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_paid' => 'boolean',
            'status' => PermitStatus::class,
            'calculated_amount' => 'decimal:2',
        ];
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(Applicant::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
