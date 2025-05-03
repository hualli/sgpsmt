<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Http\Resources\ZoneResource;
use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ZoneResource::collection(Zone::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreZoneRequest $request)
    {
        $zone = Zone::create($request->validated());

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
        $zone->update($request->validated());

        return new ZoneResource($zone);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        $zoneName = $zone->name;
        $zone->delete();

        return response()->json([
            'message' => "La zona '{$zoneName}' fue eliminada correctamente.",
        ], 200);
    }
}
