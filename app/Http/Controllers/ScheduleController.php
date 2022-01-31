<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use App\Models\lessonsOrder;
use App\Models\Schedule;
use App\Models\weekDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{

    public function createSchedule (Request $request) {
        $val = Validator::make($request->all(), [
            'week_day_id' => 'required|integer',
            'lesson_order_id' => 'required|integer',
            'department_id' => 'required|integer',
            'start_time' => 'required|array:hours,minutes',
            'start_time.hours' => "required|min:2|max:2|string",
            'start_time.minutes' => "required|min:2|max:2|string",
            'end_time' => 'required|array:hours,minutes',
            'end_time.hours' => "required|min:2|max:2|string",
            'end_time.minutes' => "required|min:2|max:2|string",
            'break' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $val = Validator::make($request->all(), [
            'start_time.hours' => 'numeric',
            'start_time.minutes' => 'numeric',
            'end_time.hours' => 'numeric',
            'end_time.minutes' => 'numeric',
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        if (!$request->break) {
            $request->break = 0;
        }

        $weekDay = weekDay::find($request->week_day_id);

        if (!$weekDay) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого дня недели не существует',
                'errors' => $val->errors()], 422);
        }

        $lessonOrder = lessonsOrder::find($request->lesson_order_id);

        if (!$lessonOrder) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такой пары не существует',
                'errors' => $val->errors()], 422);
        }

        $department = Department::find($request->department_id);

        if (!$department) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого отделения не существует',
                'errors' => $val->errors()], 422);
        }

        $hoursDifference = $request->end_time['hours'] - $request->start_time['hours'];
        $minutesDifference = $request->end_time['minutes'] - $request->start_time['minutes'];
        if ($hoursDifference<=0 && $minutesDifference<=0) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Неккоректно задано время, длительность пары составляет 0 минут',
                'errors' => $val->errors()], 422);
        }

        $schedule = Schedule::where('week_day_id', $request->week_day_id)
            ->where('lesson_order_id', $request->lesson_order_id)
            ->where('department_id', $request->department_id)->first();

        if (!!$schedule) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Для выбранного отделения, дня недели и пары расписание уже существует',
                'errors' => $val->errors()], 422);
        }
        $code = $this->codeGenerate(Schedule::class);
        Schedule::create([
            'week_day_id' => $request->week_day_id,
            'lesson_order_id' => $request->lesson_order_id,
            'department_id' => $request->department_id,
            'start_time' => join(':', $request->start_time),
            'end_time' => join(':', $request->end_time),
            'break' => $request->break,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Расписание было успешно добавлено',
            'errors' => $val->errors()], 200);
    }

    public function editSchedule (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|integer|exists:schedules,code',
            'week_day_id' => 'required_without_all:start_time,end_time,break|integer',
            'lesson_order_id' => 'required_without_all:start_time,end_time,break|integer',
            'department_id' => 'required_without_all:start_time,end_time,break|integer',
            'start_time' => 'required_without_all:week_day_id,lesson_order_id,end_time,department_id,break|required_with:end_time|array:hours,minutes',
            'start_time.hours' => "required_with_all:end_time,start_time|min:2|max:2|string",
            'start_time.minutes' => "required_with_all:end_time,start_time|min:2|max:2|string",
            'end_time' => 'required_without_all:week_day_id,lesson_order_id,start_time,department_id,break|required_with:start_time|array:hours,minutes',
            'end_time.hours' => "required_with_all:end_time,start_time|min:2|max:2|string",
            'end_time.minutes' => "required_with_all:end_time,start_time|min:2|max:2|string",
            'break' => 'integer|required_without_all:week_day_id,lesson_order_id,start_time,end_time,department_id'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $val = Validator::make($request->all(), [
            'start_time.hours' => 'numeric',
            'start_time.minutes' => 'numeric',
            'end_time.hours' => 'numeric',
            'end_time.minutes' => 'numeric',
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }
        $schedule = Schedule::where('code', '=', $request->code)->first();

        if (!$schedule) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого расписания не существует',
                'errors' => $val->errors()], 422);
        }

        if ($request->week_day_id) {
            $weekDay = weekDay::find($request->week_day_id);

            if (!$weekDay) {
                return response()->json(['title' => 'Ошибка',
                    'text' => 'Такого дня недели не существует',
                    'errors' => $val->errors()], 422);
            }

            $schedule->week_day_id = $request->week_day_id;
        }

        if ($request->lesson_order_id) {
            $lessonOrder = lessonsOrder::find($request->lesson_order_id);

            if (!$lessonOrder) {
                return response()->json(['title' => 'Ошибка',
                    'text' => 'Такой пары не существует',
                    'errors' => $val->errors()], 422);
            }

            $schedule->lesson_order_id = $request->lesson_order_id;
        }

        if ($request->department_id) {
            $department = Department::find($request->department_id);

            if (!$department) {
                return response()->json(['title' => 'Ошибка',
                    'text' => 'Такого отделения не существует',
                    'errors' => $val->errors()], 422);
            }

            $schedule->department_id = $request->department_id;
        }

        if ($request->start_time && $request->end_time) {
            $hoursDifference = $request->end_time['hours'] - $request->start_time['hours'];
            $minutesDifference = $request->end_time['minutes'] - $request->start_time['minutes'];
            if ($hoursDifference<=0 && $minutesDifference<=0) {
                return response()->json(['title' => 'Ошибка',
                    'text' => 'Некорректно задано время, длительность пары составляет 0 минут',
                    'errors' => $val->errors()], 422);
            }
            $schedule->start_time = join(':', $request->start_time);
            $schedule->end_time = join(':', $request->end_time);
        }

        $scheduleCheck = Schedule::where('week_day_id', $schedule->week_day_id)
            ->where('lesson_order_id', $schedule->lesson_order_id)
            ->where('department_id', $schedule->department_id)->first();

        if (!!$scheduleCheck) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Для выбранного отделения, дня недели и пары существует расписание',
                'errors' => $val->errors()], 422);
        }

        $schedule->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Расписание было успешно отредактировано',
            'errors' => $val->errors()], 200);
    }

    public function deleteSchedule (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|integer|exists:schedules,code'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $schedule = Schedule::where('code', '=', $request->code)->first();

        $schedule->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Расписание было успешно удалено',
            'errors' => $val->errors()], 200);
    }
}
