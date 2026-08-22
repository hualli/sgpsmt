<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $cuit_cuil
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\ApplicantFactory factory($count = null, $state = [])
 * @method \Illuminate\Database\Eloquent\Relations\HasMany permits()
 */
class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuit_cuil',
        'name',
        'email',
        'phone',
    ];

    public function permits(): HasMany
    {
        return $this->hasMany(Permit::class);
    }
}
