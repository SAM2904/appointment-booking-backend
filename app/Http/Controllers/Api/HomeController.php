<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Weekday;

class HomeController extends Controller
{
    public function services()
    {
        $services = Service::select('id', 'name', 'duration_minutes')->get();

        if ($services->count() == 0) {
            return response()->json([
                "status" => false,
                "message" => "No Services present at this time.",
            ], 200);
        }
        return response()->json([
            "status" => true,
            "message" => "Services list fetched successfully.",
            'data' => $services,
        ], 200);
    }

    public function weekdays()
    {
        $weekdays = Weekday::select('id', 'name')->get();
        if ($weekdays->count() == 0) {
            return response()->json([
                'status' => false,
                'message' => 'No Weekdays are avialble.',
            ], 200);
        }
        return response()->json([
            'status' => true,
            'message' => 'Weekdays list fetched.',
            'data' => $weekdays
        ], 200);
    }
}
