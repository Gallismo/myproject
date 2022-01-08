<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\weekDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeekDaysController extends Controller
{
    public function createWeekDay (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string|unique:week_days'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }
        $code = $this->codeGenerate(weekDay::class);
        weekDay::create([
            'name' => $request->name,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'День недели был успешно добавлен',
            'errors' => $val->errors()], 200);
    }

    public function editWeekDay (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $weekDay = weekDay::where('code', '=', $request->code)->first();

        if(is_null($weekDay)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого дня недели не существует',
                'errors' => $val->errors()], 422);
        }

        $weekDay->name = $request->name;

        $weekDay->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'День недели был успешно отредактирован',
            'errors' => $val->errors()], 200);
    }

    public function deleteWeekDay (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $weekDay = weekDay::where('code', '=', $request->code)->first();

        if(is_null($weekDay)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого дня недели не существует',
                'errors' => $val->errors()], 422);
        }

        $weekDay->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'День недели был успешно удален',
            'errors' => $val->errors()], 200);
    }
}
