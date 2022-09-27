<?php

namespace App\Actions;

use App\Models\lessonsBooking;

class AudienceCheckAction implements \App\Contracts\AudienceCheckContract
{

    public function __invoke(array $request, lessonsBooking $lesson = null)
    {
        if (empty($request) && !is_null($lesson)) {
            return lessonsBooking::where('lesson_date', $lesson->lesson_date)
                ->where('lesson_order_id', $lesson->lesson_order_id)
                ->where('audience_id', $lesson->audience_id)->first();
        }
        return lessonsBooking::where('lesson_date', $request['lesson_date'])
            ->where('lesson_order_id', $request['lesson_order_id'])
            ->where('audience_id', $request['audience_id'])->first();
    }
}
