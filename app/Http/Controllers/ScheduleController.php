<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\lessonsOrder;
use App\Models\Schedule;
use App\Models\weekDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{

    public function massCreateSchedule (Request $request) {
        $weekDays = weekDay::all();
        $lessonOrders = lessonsOrder::all();
        $departments = Department::all();
        Schedule::truncate();
        foreach ($weekDays as $weekDay) {
            foreach ($departments as $department) {
                foreach ($lessonOrders as $lessonOrder) {
                    Schedule::create([
                        'week_day_id' => $weekDay->id,
                        'lesson_order_id' => $lessonOrder->id,
                        'department_id' => $department->id,
                        'start_time' => '11:00',
                        'end_time' => '12:00',
                        'break' => 5
                    ]);
                }
            }
        }

        return response()->json(['response' => 'Schedules created'], 200);
    }

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
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $val = Validator::make($request->all(), [
            'start_time.hours' => 'numeric',
            'start_time.minutes' => 'numeric',
            'end_time.hours' => 'numeric',
            'end_time.minutes' => 'numeric',
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        if (!$request->break) {
            $request->break = 0;
        }

        $weekDay = weekDay::find($request->week_day_id);

        if (!$weekDay) {
            return response()->json(['response' => 'Week day does not exist'], 422);
        }

        $lessonOrder = lessonsOrder::find($request->lesson_order_id);

        if (!$lessonOrder) {
            return response()->json(['response' => 'Lesson order does not exist'], 422);
        }

        $department = Department::find($request->department_id);

        if (!$department) {
            return response()->json(['response' => 'Department does not exist'], 422);
        }

        $hoursDifference = $request->end_time['hours'] - $request->start_time['hours'];
        $minutesDifference = $request->end_time['minutes'] - $request->start_time['minutes'];
        if ($hoursDifference<=0 && $minutesDifference<=0) {
                return response()->json(['response' => 'Incorrect time difference'], 422);
        }

        $schedule = Schedule::where('week_day_id', $request->week_day_id)
            ->where('lesson_order_id', $request->lesson_order_id)
            ->where('department_id', $request->department_id)->first();

        if (!!$schedule) {
            return response()->json(['response' => 'Schedule already exist'], 422);
        }

        Schedule::create([
            'week_day_id' => $request->week_day_id,
            'lesson_order_id' => $request->lesson_order_id,
            'department_id' => $request->department_id,
            'start_time' => join(':', $request->start_time),
            'end_time' => join(':', $request->end_time),
            'break' => $request->break
        ]);

        return response()->json(['response' => 'Schedule created'], 200);
    }

    public function editSchedule (Request $request, $id) {
        $val = Validator::make($request->all(), [
            'week_day_id' => 'required_without_all:lesson_order_id,department_id,start_time,end_time,break|integer',
            'lesson_order_id' => 'required_without_all:week_day_id,department_id,start_time,end_time,break|integer',
            'department_id' => 'required_without_all:week_day_id,lesson_order_id,start_time,end_time,break|integer',
            'start_time' => 'required_without_all:week_day_id,lesson_order_id,end_time,department_id,break|required_with:end_time|array:hours,minutes',
            'start_time.hours' => "required_with_all:end_time,start_time|min:2|max:2|string",
            'start_time.minutes' => "required_with_all:end_time,start_time|min:2|max:2|string",
            'end_time' => 'required_without_all:week_day_id,lesson_order_id,start_time,department_id,break|required_with:start_time|array:hours,minutes',
            'end_time.hours' => "required_with_all:end_time,start_time|min:2|max:2|string",
            'end_time.minutes' => "required_with_all:end_time,start_time|min:2|max:2|string",
            'break' => 'integer|required_without_all:week_day_id,lesson_order_id,start_time,end_time,department_id'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $val = Validator::make($request->all(), [
            'start_time.hours' => 'numeric',
            'start_time.minutes' => 'numeric',
            'end_time.hours' => 'numeric',
            'end_time.minutes' => 'numeric',
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['response' => 'Schedule doesnt exist'], 422);
        }

        if ($request->week_day_id) {
            $weekDay = weekDay::find($request->week_day_id);

            if (!$weekDay) {
                return response()->json(['response' => 'Week day does not exist'], 422);
            }

            $schedule->week_day_id = $request->week_day_id;
        }

        if ($request->lesson_order_id) {
            $lessonOrder = lessonsOrder::find($request->lesson_order_id);

            if (!$lessonOrder) {
                return response()->json(['response' => 'Lesson order does not exist'], 422);
            }

            $schedule->lesson_order_id = $request->lesson_order_id;
        }

        if ($request->department_id) {
            $department = Department::find($request->department_id);

            if (!$department) {
                return response()->json(['response' => 'Department does not exist'], 422);
            }

            $schedule->department_id = $request->department_id;
        }

        if ($request->start_time && $request->end_time) {
            $hoursDifference = $request->end_time['hours'] - $request->start_time['hours'];
            $minutesDifference = $request->end_time['minutes'] - $request->start_time['minutes'];
            if ($hoursDifference<=0 && $minutesDifference<=0) {
                return response()->json(['response' => 'Incorrect time difference'], 422);
            }
            $schedule->start_time = join(':', $request->start_time);
            $schedule->end_time = join(':', $request->end_time);
        }

        $scheduleCheck = Schedule::where('week_day_id', $schedule->week_day_id)
            ->where('lesson_order_id', $schedule->lesson_order_id)
            ->where('department_id', $schedule->department_id)->first();

        if (!!$scheduleCheck) {
            return response()->json(['response' => 'Schedule already exist'], 422);
        }

        $schedule->save();

        return response()->json(['response' => 'Schedule edited'], 200);
    }

    public function deleteSchedule (Request $request, $id) {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json(['response' => 'Schedule does not exist'], 422);
        }

        $schedule->delete();

        return response()->json(['response' => 'Schedule deleted'], 200);
    }
}
