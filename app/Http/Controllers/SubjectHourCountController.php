<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\subjectHourCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectHourCountController extends Controller
{
    public function createHourCount (Request $request) {
        $val = Validator::make($request->all(), [
            'group' => 'required|integer|exists:groups,id',
            'subject' => 'required|integer|exists:subjects,id',
            'hours' => 'required|integer|min:1'
        ]);

        if($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $subjectHourCountCheck = subjectHourCount::where('group_id', $request->group)
            ->where('subject_id', $request->subject)->first();

        if(!is_null($subjectHourCountCheck)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такой предмет уже привязан к группе',
                'errors' => $val->errors()], 422);
        }

        $code = $this->codeGenerate(subjectHourCount::class);
        $record = subjectHourCount::create([
            'group_id' => $request->group,
            'subject_id' => $request->subject,
            'hours_all' => $request->hours,
            'hours_left' => $request->hours,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Предмет был успешно привязан к группе',
            'errors' => $val->errors()], 200);
    }

    public function deleteHourCount (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|exists:subject_hour_counts,code'
        ]);

        if($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $record = subjectHourCount::where('code', '=', $request->code)->first();
        $record->delete();
        return response()->json(['title' => 'Успешно',
            'text' => 'Предмет был успешно отвязан от группы, счётчик очищен',
            'errors' => $val->errors()], 200);
    }

    public function editHourCount (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|exists:subject_hour_counts,code',
            'group' => 'required_without_all:hours_all,hours_left|integer|exists:groups,id',
            'subject' => 'required_without_all:hours_left,hours_all|integer|exists:subjects,id',
            'hours_all' => 'required_without_all:group,subject,hours_left|integer|min:1',
            'hours_left' => 'required_without_all:group,subject,hours_all|integer|min:1'
        ]);

        if($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $subjectHourCountCheck = subjectHourCount::where('group_id', $request->group)
            ->where('subject_id', $request->subject)->first();

        if(!is_null($subjectHourCountCheck)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Предмет уже привязан к группе',
                'errors' => $val->errors()], 422);
        }

        $record = subjectHourCount::where('code', '=', $request->code)->first();

        $request->group ? $record->group_id=$request->group : false;
        $request->subject ? $record->subject_id=$request->subject : false;
        $request->hours_all ? $record->hours_all=$request->hours_all : false;
        $request->hours_left ? $record->hours_left=$request->hours_left : false;

        $record->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Привязка была успешно отредактирована',
            'errors' => $val->errors()], 200);
    }
}
