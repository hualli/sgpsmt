<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_from',
        'day_to',
        'time_from',
        'time_to',
        'label',
        'zone_id'
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}