<?php

namespace App\Actions;

use App\Models\lessonsBooking;

class GroupCheckAction implements \App\Contracts\GroupCheckContract
{

    public function __invoke(array $request, lessonsBooking $lesson = null): null|lessonsBooking
    {
        if (empty($request) && !is_null($lesson)) {
            return lessonsBooking::where('lesson_date', $lesson->lesson_date)
                ->where('lesson_order_id', $lesson->lesson_order_id)
                ->where('group_id', $lesson->group_id)->where('group_part_id', $lesson->group_part_id)->first();
        }
        return lessonsBooking::where('lesson_date', $request['lesson_date'])
            ->where('lesson_order_id', $request['lesson_order_id'])
            ->where('group_id', $request['group_id'])->where('group_part_id', $request['group_part_id'])->first();
    }
}
