<?php

namespace App\Http\Controllers;

use App\Contracts\AudienceCheckContract;
use App\Contracts\GroupCheckContract;
use App\Contracts\LessonEditContract;
use App\Contracts\TeacherCheckContract;
use App\Http\Requests\Admin\LessonsBookingsRequest;
use App\Models\Audience;
use App\Models\Group;
use App\Models\lessonsBooking;
use App\Models\lessonsOrder;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class LessonsBookingsController extends Controller
{
    public function createLessonBooking (LessonsBookingsRequest $request, AudienceCheckContract $audienceCheck,
                                         TeacherCheckContract $teacherCheck, LessonEditContract $lessonEdit,
                                         GroupCheckContract $groupCheck): JsonResponse
    {
        $request = $request->validated();

        if ($lesson = $audienceCheck($request)) {
            return $this->sendError('Ошибка', 'Аудитория занята',
                $this->generateAudMessage($lesson), 422);
        }

        if ($lesson = $teacherCheck($request)) {
            return $this->sendError('Ошибка', 'Преподаватель уже закреплен за другой парой',
                $this->generateTeachMessage($lesson), 422);
        }

        if ($lesson = $groupCheck($request)) {
            return $this->sendError('Ошибка', 'У группы уже есть пара',
                $this->generateGroupMessage($lesson), 422);
        }

        $lesson = $lessonEdit($request, new lessonsBooking);
        $lesson->save();

        return $this->sendResp('Успешно', 'Пара была успешно добавлена', 200);
    }

    public function deleteLessonBooking (LessonsBookingsRequest $request)
    {
        $request = $request->validated();

        return $this->deleteSomething(new lessonsBooking(),
            $request['id'], $this->sendResp('Успешно', 'Пара была успешно удалена', 200));
    }

    public function editLessonBooking (LessonsBookingsRequest $request, AudienceCheckContract $audienceCheck,
                                       TeacherCheckContract $teacherCheck, LessonEditContract $lessonEdit,
                                       GroupCheckContract $groupCheck): JsonResponse
    {
        $request = $request->validated();

        $lessonEdited = $lessonEdit($request, lessonsBooking::find($request['id']));

        if ($lesson = $audienceCheck(array(), $lessonEdited)) {
            return $this->sendError('Ошибка', 'Аудитория занята',
                $this->generateAudMessage($lesson), 422);
        }

        if ($lesson = $teacherCheck(array(), $lessonEdited)) {
            return $this->sendError('Ошибка', 'Преподаватель уже закреплен за другой парой',
                $this->generateTeachMessage($lesson), 422);
        }

        if ($lesson = $groupCheck(array(), $lessonEdited)) {
            return $this->sendError('Ошибка', 'У группы уже есть пара',
                $this->generateGroupMessage($lesson), 422);
        }

        $lessonEdited->save();

        return $this->sendResp('Успешно', 'Пара была успешно отредактирована', 200);
    }




    private function generateAudMessage(lessonsBooking $lesson)
    {
        return (object)[
            'date' => [
                $lesson->lesson_date.", ".lessonsOrder::find($lesson->lesson_order_id)->name
            ],
            'description' => [
                Audience::find($lesson->audience_id)->name.", "
                .Subject::find($lesson->subject_id)->name.", "
                .Group::find($lesson->group_id)->name.", "
                .User::find($lesson->teacher_id)->name
            ]
        ];
    }

    private function generateTeachMessage(lessonsBooking $lesson)
    {
        return (object)[
            'date' => [
                $lesson->lesson_date.", ".lessonsOrder::find($lesson->lesson_order_id)->name
            ],
            'description' => [
                Audience::find($lesson->audience_id)->name.", "
                .Subject::find($lesson->subject_id)->name.", "
                .Group::find($lesson->group_id)->name.", "
                .User::find($lesson->teacher_id)->name
            ]
        ];
    }

    private function generateGroupMessage(lessonsBooking $lesson)
    {
        return (object)[
            'date' => [
                $lesson->lesson_date.", ".lessonsOrder::find($lesson->lesson_order_id)->name
            ],
            'description' => [
                Audience::find($lesson->audience_id)->name.", "
                .Subject::find($lesson->subject_id)->name.", "
                .Group::find($lesson->group_id)->name.", "
                .User::find($lesson->teacher_id)->name
            ]
        ];
    }
}
