<?php

namespace App\Contracts;

use App\Models\lessonsBooking;

interface GroupCheckContract
{
    public function __invoke(array $request, lessonsBooking $lesson = null): null|lessonsBooking;
}
