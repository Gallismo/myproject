<?php

namespace App\Contracts;

use App\Models\lessonsBooking;

interface AudienceCheckContract
{
    public function __invoke(array $request, lessonsBooking $lesson = null);
}
