<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Http\Resources\ZoneResource;
use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Services\ZoneService;

class ZoneController extends Controller
{
    protected $zoneService;

    public function __construct(ZoneService $zoneService)
    {
        $this->zoneService = $zoneService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ZoneResource::collection($this->zoneService->getAllZones());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreZoneRequest $request)
    {
        $zone = $this->zoneService->createZone($request->validated());

        return new ZoneResource($zone);
    }

    /**
     * Display the specified resource.
     */
    public function show(Zone $zone)
    {
        return new ZoneResource($zone);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        $this->zoneService->updateZone($zone, $request->validated());

        return new ZoneResource($zone);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        $zoneName = $zone->name;
        $this->zoneService->deleteZone($zone);

        return response()->json([
            'message' => "La zona '{$zoneName}' fue eliminada correctamente.",
        ], 200);
    }
}
