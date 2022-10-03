<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\WeekRequest;
use App\Models\Audience;
use App\Models\weekDay;
use Illuminate\Http\JsonResponse;

class WeekDaysController extends Controller
{
    public function createWeekDay (WeekRequest $request): JsonResponse
    {
        $request = $request->validated();

        weekDay::create([
            'name' => $request['name']
        ]);

        return $this->sendResp('Успешно', 'День недели был успешно добавлен', 200);
    }

    public function editWeekDay (WeekRequest $request): JsonResponse
    {
        $request = $request->validated();

        $weekDay = weekDay::find($request['id']);
        $weekDay->name = $request['name'];
        $weekDay->save();

        return $this->sendResp('Успешно', 'День недели был успешно отредактирован', 200);
    }

    public function deleteWeekDay (WeekRequest $request): JsonResponse
    {
        $request = $request->validated();

        return $this->deleteSomething(new weekDay(), $request['id'],
            $this->sendResp('Успешно', 'День недели был успешно удален', 200));
    }
}
