<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimeSlot;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        TimeSlot::create([
            'day_from' => 'lunes',
            'day_to' => 'viernes',
            'time_from' => '14:00',
            'time_to' => '17:30',
            'label' => 'Lunes a Viernes de 14 a 17:30 hs',
            'zone_id' => 1
        ]);
        TimeSlot::create([
            'day_from' => 'lunes',
            'day_to' => 'viernes',
            'time_from' => '20:00',
            'time_to' => '21:30',
            'label' => 'Lunes a Viernes de 20 a 21:30 hs',
            'zone_id' => 2
        ]);
        TimeSlot::create([
            'day_from' => 'lunes',
            'day_to' => 'viernes',
            'time_from' => '08:00',
            'time_to' => '12:30',
            'label' => 'Lunes a Viernes de 08 a 12:30 hs',
            'zone_id' => 3
        ]);
    }
}