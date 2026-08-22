<?php

namespace App\Http\Controllers;

use App\Enums\PermitStatus;
use App\Http\Requests\Admin\PermitUpdateStatusRequest;
use App\Models\Permit;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PermitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $permits = Permit::with(['applicant', 'zone'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('permits.index', compact('permits'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Permit $permit): View
    {
        $permit->load(['applicant', 'zone', 'documents']);

        return view('permits.show', compact('permit'));
    }

    /**
     * Update the status and/or payment state of the specified resource.
     */
    public function updateStatus(PermitUpdateStatusRequest $request, Permit $permit): RedirectResponse
    {
        $validated = $request->validated();

        if (array_key_exists('status', $validated)) {
            $permit->status = PermitStatus::from($validated['status']);
        }

        if (array_key_exists('is_paid', $validated)) {
            $permit->is_paid = $validated['is_paid'];
        }

        $permit->save();

        return back()->with('success', 'Estado del permiso actualizado correctamente.');
    }
}
