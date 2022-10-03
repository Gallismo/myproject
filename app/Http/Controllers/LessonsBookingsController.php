<?php

namespace App\Http\Controllers;

use App\Contracts\AudienceCheckContract;
use App\Contracts\LessonEditContract;
use App\Contracts\TeacherCheckContract;
use App\Http\Requests\Admin\LessonsBookingsRequest;
use App\Models\Audience;
use App\Models\lessonsBooking;
use App\Models\lessonsOrder;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class LessonsBookingsController extends Controller
{
    public function createLessonBooking (LessonsBookingsRequest $request, AudienceCheckContract $audienceCheck,
                                         TeacherCheckContract $teacherCheck, LessonEditContract $lessonEdit): JsonResponse
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
                                       TeacherCheckContract $teacherCheck, LessonEditContract $lessonEdit): JsonResponse
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

        $lessonEdited->save();

        return $this->sendResp('Успешно', 'Пара была успешно отредактирована', 200);
    }




    private function generateAudMessage($lesson): object
    {
        return (object)[
            'Дата, Пара' =>
                $lesson->lesson_date.", ".lessonsOrder::find($lesson->lesson_order_id)->name,
            'Аудитория, Предмет, Преподаватель' =>
                Audience::find($lesson->audience_id)->name.", "
                .Subject::find($lesson->subject_id)->name.", "
                .User::find($lesson->teacher_id)->name
        ];
    }

    private function generateTeachMessage($lesson): object
    {
        return (object)[
            'Дата, Пара' =>
                $lesson->lesson_date.", ".lessonsOrder::find($lesson->lesson_order_id)->name,
            'Аудитория, Предмет, Преподаватель' =>
                Audience::find($lesson->audience_id)->name.", "
                .Subject::find($lesson->subject_id)->name.", "
                .User::find($lesson->teacher_id)->name
        ];
    }
}
