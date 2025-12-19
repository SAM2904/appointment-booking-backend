<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Appointment;
use App\Models\Service;
use App\Services\AvailabilityService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(BookingRequest $request)
    {
        $service = Service::where('id', $request->service_id)
            ->where('is_active', 1)
            ->firstOrFail();

        //Start:: First check that requested datetime is not the past datetime.
        $start = Carbon::createFromFormat('Y-m-d H:i', $request->start_at);
        if ($start->lessThanOrEqualTo(now())) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot book a past or current time.'
            ], 422);
        }
        //End:: First check that requested datetime is not the past datetime.

        $end = $start->copy()->addMinutes($service->duration_minutes);

        //Start::Check if request datetime has overlap any existing appointment.
        $exists = Appointment::whereIn('status', [0, 1])
            ->where(function ($q) use ($start, $end) {
                $q->where('start_at', '<', $end)
                    ->where('end_at', '>', $start);
            })
            ->exists();
        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Slot already booked.'
            ], 409);
        }
        //End::Check if request datetime has overlap any existing appointment.

        //Start::Validate that requested datetime has any available/vacant timeslot.
        $availableSlots = (new AvailabilityService())->getAvailableSlots($service, $start->copy()->startOfDay());

        $isValidSlot = collect($availableSlots)
            ->pluck('start')
            ->contains($start->format('Y-m-d H:i'));
        if (!$isValidSlot) {
            return response()->json([
                'status' => false,
                'message' => 'Selected time slot is not available.'
            ], 422);
        }
        //End::Validate that requested datetime has any available/vacant timeslot.

        $appointment = Appointment::create([
            'service_id' => $service->id,
            'start_at' => $start,
            'end_at' => $end,
            'client_email' => $request->client_email,
            'status' => 0
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Appointment booked successfully.',
            'data' => $appointment
        ]);
    }
}
