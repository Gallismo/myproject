<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\LessonsOrdersRequest;
use App\Models\Audience;
use App\Models\lessonsOrder;
use Illuminate\Http\JsonResponse;

class LessonsOrdersController extends Controller
{
    public function createLessonsOrder (LessonsOrdersRequest $request): JsonResponse
    {
        $request = $request->validated();

        lessonsOrder::create([
            'name' => $request['name']
        ]);

        return $this->sendResp('Успешно', 'Пара(расписание) была добавлена', 200);
    }

    public function editLessonsOrder (LessonsOrdersRequest $request): JsonResponse
    {
        $request = $request->validated();

        $lessonsOrder = lessonsOrder::find($request['id']);
        $lessonsOrder->name = $request['name'];
        $lessonsOrder->save();

        return $this->sendResp('Успешно', 'Пара(расписание) была отредактирована', 200);
    }

    public function deleteLessonsOrder (LessonsOrdersRequest $request): JsonResponse
    {
        $request = $request->validated();

        return $this->deleteSomething(new lessonsOrder(), $request['id'],
            $this->sendResp('Успешно', 'Пара(расписание) была удалена', 200));
    }
}
