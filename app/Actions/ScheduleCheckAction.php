<?php

namespace App\Actions;

use App\Models\lessonsBooking;
use App\Models\Schedule;

class ScheduleCheckAction implements \App\Contracts\ScheduleCheckContract
{

    public function __invoke(array $request, Schedule $schedule = null): Schedule
    {
        if (empty($request) && !is_null($schedule)) {
            return Schedule::where('week_day_id', $schedule->week_day_id)
                    ->where('lesson_order_id', $schedule->lesson_order_id)
                    ->where('department_id', $schedule->department_id)->first();
        }
        return Schedule::where('week_day_id', $request['week_day_id'])
                ->where('lesson_order_id', $request['lesson_order_id'])
                ->where('department_id', $request['department_id'])->first();
    }
}
