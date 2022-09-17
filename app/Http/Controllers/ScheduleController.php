<?php

namespace App\Http\Controllers;

use App\Contracts\ScheduleCheckContract;
use App\Contracts\ScheduleEditContract;
use App\Http\Requests\ScheduleRequest;
use App\Models\Audience;
use App\Models\Department;
use App\Models\Group;
use App\Models\lessonsOrder;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use App\Models\weekDay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    private \Illuminate\Validation\Validator $val;
    private function validateTimes(array $request) {
        $this->val = Validator::make($request, [
            'start_time.hours' => 'numeric',
            'start_time.minutes' => 'numeric',
            'end_time.hours' => 'numeric',
            'end_time.minutes' => 'numeric',
        ]);

        return $this->val->fails();
    }

    public function createSchedule (ScheduleRequest $request, ScheduleCheckContract $scheduleCheck,
                                    ScheduleEditContract $scheduleEdit): JsonResponse
    {
        $request = $request->validated();

        if ($this->validateTimes($request)) {
            return $this->sendError('Ошибка валидации', 'Проверьте правильность заполнения полей', $this->val->errors(), 422);
        }

        $hoursDifference = $request['end_time']['hours'] - $request['start_time']['hours'];
        $minutesDifference = $request['end_time']['minutes'] - $request['start_time']['minutes'];
        if ($hoursDifference<=0 && $minutesDifference<=0) {
            return $this->sendResp('Ошибка', 'Неккоректно задано время, длительность пары составляет 0 минут', 422);
        }

        if ($scheduleCheck($request)) {
            return $this->sendResp('Ошибка', 'Для выбранного отделения, дня недели и пары уже существует расписание', 422);
        }

        $scheduleEdit($request, new Schedule)->save();


        return $this->sendResp('Успешно', 'Расписание было успешно добавлено', 200);
    }

    public function editSchedule (ScheduleRequest $request, ScheduleEditContract $scheduleEdit,
                                  ScheduleCheckContract $scheduleCheck): JsonResponse
    {
        $request = $request->validated();

        if ($request['start_time'] && $request['end_time']) {
            if ($this->validateTimes($request)) {
                return $this->sendError('Ошибка валидации', 'Проверьте правильность заполнения полей', $this->val->errors(), 422);
            }

            $hoursDifference = $request['end_time']['hours'] - $request['start_time']['hours'];
            $minutesDifference = $request['end_time']['minutes'] - $request['start_time']['minutes'];
            if ($hoursDifference<=0 && $minutesDifference<=0) {
                return $this->sendResp('Ошибка', 'Некорректно задано время, длительность пары составляет 0 минут', 422);
            }
        }

        $schedule = $scheduleEdit($request, Schedule::find($request['id']));

        if ($scheduleCheck([], $schedule)) {
            return $this->sendResp('Ошибка', 'Для выбранного отделения, дня недели и пары уже существует расписание', 422);
        }

        $schedule->save();

        return $this->sendResp('Успешно', 'Расписание было успешно отредактировано', 200);
    }

    public function deleteSchedule (ScheduleRequest $request) {
        $request = $request->validated();

        Schedule::find($request['id']);

        return $this->sendResp('Успешно', 'Расписание было успешно удалено', 200);
    }
}
