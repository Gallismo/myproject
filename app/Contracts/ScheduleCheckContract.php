<?php

namespace App\Contracts;

use App\Models\Schedule;

interface ScheduleCheckContract
{
    public function __invoke(array $request, Schedule $schedule = null): Schedule | null;
}
