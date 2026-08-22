<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RateStoreRequest;
use App\Http\Requests\Admin\RateUpdateRequest;
use App\Models\Rate;
use App\Models\Zone;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $rates = Rate::with('zone')->orderBy('zone_id')->paginate(15);

        return view('admin.rates.index', compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $zones = Zone::orderBy('name')->get();

        return view('admin.rates.create', compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RateStoreRequest $request): RedirectResponse
    {
        Rate::create($request->validated());

        return redirect()->route('rates.index')
            ->with('success', 'Tarifa creada correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rate $rate): View
    {
        $zones = Zone::orderBy('name')->get();

        return view('admin.rates.edit', compact('rate', 'zones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RateUpdateRequest $request, Rate $rate): RedirectResponse
    {
        $rate->update($request->validated());

        return redirect()->route('rates.index')
            ->with('success', 'Tarifa actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate): RedirectResponse
    {
        $rate->delete();

        return redirect()->route('rates.index')
            ->with('success', 'Tarifa eliminada correctamente.');
    }
}
