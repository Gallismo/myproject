<?php

namespace App\Actions;

use App\Models\Schedule;

class ScheduleEditAction implements \App\Contracts\ScheduleEditContract
{

    public function __invoke(array $request, Schedule $schedule): Schedule
    {
        $schedule->week_day_id = $request['week_day_id']                     ?? $schedule->week_day_id;
        $schedule->lesson_order_id = $request['lesson_order_id']             ?? $schedule->lesson_order_id;
        $schedule->department_id = $request['department_id']                 ?? $schedule->department_id;
        $schedule->start_time = join(':', $request['start_time'])   ?? $schedule->start_time;
        $schedule->end_time = join(':', $request['end_time'])       ?? $schedule->end_time;
        $schedule->break = $request['break']                                 ?? $schedule->break                ?? 0;
        return $schedule;
    }
}
