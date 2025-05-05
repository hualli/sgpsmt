<?php

namespace App\Services;

use App\Models\TimeSlot;
use \Illuminate\Database\Eloquent\Collection;

class TimeSlotService
{
    public function getAllTimeSlots(): Collection
    {
        return TimeSlot::with('zone')->get();
    }

    public function createTimeSlot(array $data): TimeSlot
    {
        $timeSlot = TimeSlot::create($data);
        $timeSlot->load('zone');

        return $timeSlot;
    }

    public function updateTimeSlot(TimeSlot $timeSlot, array $data): TimeSlot
    {
        $timeSlot->update($data);
        $timeSlot->load('zone');

        return $timeSlot;
    }

    public function deleteTimeSlot(TimeSlot $timeSlot): ?bool
    {
        return $timeSlot->delete();
    }
}