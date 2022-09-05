<?php

namespace App\Contracts;

use App\Models\lessonsBooking;
use App\Models\Schedule;

interface ScheduleEditContract
{
    public function __invoke(array $request, Schedule $schedule): Schedule;
}
