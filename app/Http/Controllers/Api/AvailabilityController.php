<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\AvailabilityService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function getAvailability(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'service_id' => 'required|exists:services,id',
        ]);

        $service = Service::where('id', $request->service_id)
            ->where('is_active', 1)
            ->firstOrFail();

        $slots = (new AvailabilityService())->getAvailableSlots($service, Carbon::parse($request->date));

        return response()->json([
            'status' => true,
            'message' => count($slots) ? 'Slots available.' : 'No slots available.',
            'data' => $slots
        ]);
    }
}
