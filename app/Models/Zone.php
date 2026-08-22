<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\ZoneFactory factory($count = null, $state = [])
 * @method \Illuminate\Database\Eloquent\Relations\HasMany rates()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany permits()
 */
class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function permits(): HasMany
    {
        return $this->hasMany(Permit::class);
    }
}
