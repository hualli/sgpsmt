<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoneStoreRequest;
use App\Http\Requests\Admin\ZoneUpdateRequest;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $zones = Zone::orderBy('name')->paginate(15);

        return view('admin.zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.zones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ZoneStoreRequest $request): RedirectResponse
    {
        Zone::create($request->validated());

        return redirect()->route('zones.index')
            ->with('success', 'Zona creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone): View
    {
        return view('admin.zones.edit', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ZoneUpdateRequest $request, Zone $zone): RedirectResponse
    {
        $zone->update($request->validated());

        return redirect()->route('zones.index')
            ->with('success', 'Zona actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone): RedirectResponse
    {
        $zone->delete();

        return redirect()->route('zones.index')
            ->with('success', 'Zona eliminada correctamente.');
    }
}
