<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\HourCountRequest;
use App\Models\Audience;
use App\Models\subjectHourCount;
use Illuminate\Http\JsonResponse;

class SubjectHourCountController extends Controller
{
    public function createHourCount (HourCountRequest $request): JsonResponse
    {
        $request = $request->validated();

        $check = subjectHourCount::where('group_id', $request['group_id'])
            ->where('subject_id', $request['subject_id'])->first();

        if(!is_null($check)) {
            return $this->sendResp('Ошибка', 'Такой предмет уже привязан к группе', 422);
        }

        subjectHourCount::create([
            'group_id' => $request['group_id'],
            'subject_id' => $request['subject_id'],
            'hours' => $request['hours'],
        ]);

        return $this->sendResp('Успешно', 'Предмет был успешно привязан к группе', 200);
    }

    public function deleteHourCount (HourCountRequest $request): JsonResponse
    {
        $request = $request->validated();

        return $this->deleteSomething(new subjectHourCount(), $request['id'],
            $this->sendResp('Успешно', 'Предмет был успешно отвязан от группы, счётчик очищен', 200));
    }

    public function editHourCount (HourCountRequest $request): JsonResponse
    {
        $request = $request->validated();

        $record = subjectHourCount::find($request['id']);

        if (!empty($request['subject_id']) || !empty($request['group_id'])) {
            $check = subjectHourCount
                ::where('group_id', '=',   $request['group_id']   ?? $record->group_id)
                ->where('subject_id', '=', $request['subject_id'] ?? $record->subject_id)->first();

            if(!is_null($check)) {
                return $this->sendResp('Ошибка', 'Предмет уже привязан к группе', 422);
            }
        }

        $record->group_id   = $request['group_id']   ?? $record->group_id ;
        $record->subject_id = $request['subject_id'] ?? $record->subject_id;
        $record->hours      = $request['hours']      ?? $record->hours;
        $record->save();

        return $this->sendResp('Успешно', 'Привязка была успешно отредактирована', 200);
    }
}
