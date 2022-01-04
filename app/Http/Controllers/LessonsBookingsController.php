<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\groupsBooking;
use App\Models\lessonsBooking;
use App\Models\subjectHourCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonsBookingsController extends Controller
{
    public function createLessonBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'lesson_date' => 'required|date-format:Y-m-d',
            'lesson_order_id' => 'required|exists:lessons_orders,id|integer',
            'audience_id' => 'required|exists:audiences,id|integer',
            'subject_id' => 'required|exists:subjects,id|integer',
            'teacher_id' => 'required|exists:teachers,id|integer',
            'is_remote' => 'boolean'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        if (is_null($request->is_remote)) {
            $request->is_remote = false;
        }

        $lessonCheck = lessonsBooking::where('lesson_date', $request->lesson_date)
                                    ->where('lesson_order_id', $request->lesson_order_id)
                                    ->where('audience_id', $request->audience_id)->first();

        if (!is_null($lessonCheck)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Аудитория занята',
                'errors' => (object)[
                    'Дата, Пара' => $lessonCheck->lesson_date.", ".$lessonCheck->lesson_order_id,
                    'Аудитория, Предмет, Преподаватель' =>
                        $lessonCheck->audience_id.", "
                        .$lessonCheck->subject_id.", "
                        .$lessonCheck->teacher_id
                ]], 422);
        }

        $teacherArr = [];
        $teacherCheck = lessonsBooking::where('lesson_date', $request->lesson_date)
            ->where('lesson_order_id', $request->lesson_order_id)
            ->where('teacher_id', $request->teacher_id)->get();

        foreach ($teacherCheck as $item) {
            $teacherArr[] = $item;
        }

        $warning = '';
        if (array_key_exists(0, $teacherArr)) {
            $warning = (object)[
                'warning' => 'Предупреждение! Данный преподаватель уже закреплен за другой(-ими) парами!'
            ];
        }

        $code = $this->codeGenerate(lessonsBooking::class);
        lessonsBooking::create([
            'lesson_date' => $request->lesson_date,
            'lesson_order_id' => $request->lesson_order_id,
            'audience_id' => $request->audience_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'is_remote' => $request->is_remote,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Пара была успешно добавлена',
            'errors' => $warning], 200);
    }

    public function deleteLessonBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|exists:lessons_bookings,code'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $lessonBooking = lessonsBooking::where('code', '=', $request->code)->first();

        if (is_null($lessonBooking)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такой записи не существует',
                'errors' => $val->errors()], 422);
        }

        $groupArr = [];
        $groupBookingCheck = groupsBooking::where('booking_id', $lessonBooking->id)->get();

        foreach ($groupBookingCheck as $item) {
            $groupArr[] = $item;
        }

        $lessonBooking->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Пара была успешно удалена',
            'errors' => $val->errors()], 200);
    }

    public function editLessonBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|exists:lessons_bookings,code|integer',
            'lesson_date' => 'required_without_all:subject_id,teacher_id,is_remote|date-format:Y-m-d',
            'lesson_order_id' => 'required_without_all:subject_id,teacher_id,is_remote|exists:lessons_orders,id|integer',
            'audience_id' => 'required_without_all:subject_id,teacher_id,is_remote|exists:audiences,id|integer',
            'subject_id' => 'required_without_all:lesson_date,lesson_order_id,audience_id,teacher_id,is_remote|exists:subjects,id|integer',
            'teacher_id' => 'required_without_all:lesson_date,lesson_order_id,audience_id,subject_id,is_remote|exists:teachers,id|integer',
            'is_remote' => 'boolean|required_without_all:lesson_date,lesson_order_id,audience_id,subject_id,teacher_id'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $lessonCheck = lessonsBooking::where('lesson_date', $request->lesson_date)
            ->where('lesson_order_id', $request->lesson_order_id)
            ->where('audience_id', $request->audience_id)->first();

        if (!is_null($lessonCheck)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Аудитория занята',
                'errors' => $val->errors()], 422);
        }

        $lessonBooking = lessonsBooking::where('code', '=', $request->code)->first();

        $request->lesson_date ? $lessonBooking->lesson_date = $request->lesson_date : false;
        $request->lesson_order_id ? $lessonBooking->lesson_order_id = $request->lesson_order_id : false;
        $request->audience_id ? $lessonBooking->audience_id = $request->audience_id : false;
        $request->subject_id ? $lessonBooking->subject_id = $request->subject_id : false;
        $request->teacher_id ? $lessonBooking->teacher_id = $request->teacher_id : false;
        $request->is_remote ? $lessonBooking->is_remote = $request->is_remote : false;

        $teacherArr = [];
        $teacherCheck = lessonsBooking::where('lesson_date', $lessonBooking->lesson_date)
            ->where('lesson_order_id', $lessonBooking->lesson_order_id)
            ->where('teacher_id', $lessonBooking->teacher_id)->get();

        foreach ($teacherCheck as $item) {
            if ($item->id === $lessonBooking->id) {
                continue;
            }
            $teacherArr[] = $item;
        }
        $warning = '';
        if (array_key_exists(0, $teacherArr)) {
            $warning = (object)[
                'warning' => 'Предупреждение! Данный преподаватель уже закреплен за другой(-ими) парами!'
            ];
        }

        $lessonBooking->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Пара была успешно отредактирована',
            'errors' => $warning], 200);
    }
}
