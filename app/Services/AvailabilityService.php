<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Weekday;
use App\Models\WorkingTimeRule;
use Carbon\Carbon;

class AvailabilityService
{
    /**
     * Get available slot start times for a given service and date
     */
    public function getAvailableSlots(Service $service, Carbon $date): array
    {
        $weekday = Weekday::where('name', $date->dayName)->first();

        if (!$weekday) {
            return [];
        }

        $rules = WorkingTimeRule::where('weekday_id', $weekday->id)
            ->where('is_active', 1)
            ->get();

        $appointments = Appointment::whereDate('start_at', $date->toDateString())
            ->whereIn('status', [0, 1]) // Scheduled, Completed
            ->get();

        $slots = [];

        foreach ($rules as $rule) {
            $start = Carbon::parse($date->toDateString() . ' ' . $rule->start_time);
            $end   = Carbon::parse($date->toDateString() . ' ' . $rule->end_time);

            while ($start->copy()->addMinutes($service->duration_minutes) <= $end) {
                $slotEnd = $start->copy()->addMinutes($service->duration_minutes);

                $overlap = $appointments->first(
                    fn($a) =>
                    $start < $a->end_at && $slotEnd > $a->start_at
                );

                if (!$overlap && $start->isFuture()) {
                    // $slots[] = $start->format('Y-m-d H:i');
                    $slots[] = [
                        'start' => $start->format('Y-m-d H:i'),
                        'end'   => $slotEnd->format('Y-m-d H:i'),
                    ];
                }

                $start->addMinutes($service->duration_minutes);
            }
        }

        return $slots;
    }
}
