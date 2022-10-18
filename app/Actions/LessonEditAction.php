<?php

namespace App\Actions;

use App\Models\lessonsBooking;

class LessonEditAction implements \App\Contracts\LessonEditContract
{

    public function __invoke(array $request, lessonsBooking $lesson): lessonsBooking
    {
        $lesson->lesson_date = $request['lesson_date']          ?? $lesson->lesson_date;
        $lesson->lesson_order_id = $request['lesson_order_id']  ?? $lesson->lesson_order_id;
        $lesson->audience_id = $request['audience_id']          ?? $lesson->audience_id;
        $lesson->subject_id = $request['subject_id']            ?? $lesson->subject_id;
        $lesson->teacher_id = $request['teacher_id']            ?? $lesson->teacher_id;
        $lesson->group_id = $request['group_id']                ?? $lesson->group_id;
        $lesson->group_part_id = $request['group_part_id']      ?? $lesson->group_part_id;
        $lesson->is_remote = $request['is_remote']              ?? $lesson->is_remote       ?? false;
        $lesson->conference_url = $request['conference_url']    ?? $lesson->conference_url  ?? null;
        $lesson->lesson_topic = $request['lesson_topic']        ?? $lesson->lesson_topic    ?? null;
        $lesson->lesson_homework = $request['lesson_homework']  ?? $lesson->lesson_homework ?? null;
        return $lesson;
    }
}
