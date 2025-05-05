<?php

namespace App\Services;

use App\Models\Zone;
use \Illuminate\Database\Eloquent\Collection;

class ZoneService
{
    /**
     * Retrieve all zones.
     *
     * @return Collection
     */
    public function getAllZones(): Collection
    {
        return Zone::all();
    }

    /**
     * Create a new zone.
     *
     * @param array $data
     * @return Zone
     */
    public function createZone(array $data): Zone
    {
        return Zone::create($data);
    }

    /**
     * Update an existing zone.
     *
     * @param Zone $zone
     * @param array $data
     * @return bool
     */
    public function updateZone(Zone $zone, array $data): bool
    {
        return $zone->update($data);
    }

    /**
     * Delete a zone.
     *
     * @param Zone $zone
     * @return bool|null
     */
    public function deleteZone(Zone $zone): ?bool
    {
        return $zone->delete();
    }
}