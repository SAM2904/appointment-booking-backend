<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkingHoursRequest;
use App\Models\WorkingTimeRule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getWorkingHoursList(Request $request)
    {
        $query = WorkingTimeRule::with('weekday')
            ->where('is_active', 1);

        if ($request->filled('weekday_id')) {
            $query->where('weekday_id', $request->weekday_id);
        }

        $workingHours = $query
            ->orderBy('weekday_id')
            ->orderBy('start_time')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'weekday_id' => $item->weekday_id,
                    'weekday_name' => $item->weekday_name,
                    'start_time' => $item->start_time,
                    'end_time' => $item->end_time,
                    'is_active' => $item->is_active,
                ];
            });

        return response()->json([
            'status' => true,
            'message' => 'Working Times Slots are fetched successfully.',
            'data' => $workingHours
        ]);
    }

    public function storeWorkingHours(StoreWorkingHoursRequest $request)
    {
        $overlap = WorkingTimeRule::where('weekday_id', $request->weekday_id)
            ->where(function ($q) use ($request) {
                $q->where('start_time', '<', $request->end_time)
                    ->where('end_time', '>', $request->start_time);
            })
            ->exists();

        if ($overlap) {
            return response()->json([
                'status' => false,
                'message' => 'Working time overlaps with an existing rule for this day.',
            ], 422);
        }

        $data = WorkingTimeRule::create([
            'weekday_id' => $request->weekday_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Working Time has been created successfully.',
            'data' => $data,
        ]);
    }
}
