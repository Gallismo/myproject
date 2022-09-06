<?php

namespace App\Contracts;

use App\Models\lessonsBooking;

interface LessonEditContract
{
    public function __invoke(array $request, lessonsBooking $lesson): lessonsBooking;
}
