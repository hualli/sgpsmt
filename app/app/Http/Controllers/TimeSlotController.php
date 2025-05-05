<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use App\Http\Resources\TimeSlotResource;
use App\Http\Requests\StoreTimeSlotRequest;
use App\Http\Requests\UpdateTimeSlotRequest;
use App\Services\TimeSlotService;

class TimeSlotController extends Controller
{
    protected $timeSlotService;

    public function __construct(TimeSlotService $timeSlotService)
    {
        $this->timeSlotService = $timeSlotService;
    }

    public function index()
    {
        return TimeSlotResource::collection($this->timeSlotService->getAllTimeSlots());
    }

    public function show(TimeSlot $timeSlot)
    {
        $timeSlot->load('zone');

        return new TimeSlotResource($timeSlot);
    }

    public function store(StoreTimeSlotRequest $request)
    {
        $timeSlot = $this->timeSlotService->createTimeSlot($request->validated());

        return new TimeSlotResource($timeSlot);
    }

    public function update(UpdateTimeSlotRequest $request, TimeSlot $timeSlot)
    {
        $this->timeSlotService->updateTimeSlot($timeSlot, $request->validated());

        return new TimeSlotResource($timeSlot);
    }

    public function destroy(TimeSlot $timeSlot)
    {
        $this->timeSlotService->deleteTimeSlot($timeSlot);

        return response()->json(['message' => 'Time slot deleted successfully.'], 200);
    }
}