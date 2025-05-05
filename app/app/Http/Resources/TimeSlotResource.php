<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeSlotResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'day_from' => $this->day_from,
            'day_to' => $this->day_to,
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
            'label' => $this->label,
            'zone' => new ZoneResource($this->whenLoaded('zone'))
        ];
    }
}