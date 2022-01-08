<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function createSubject (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string|unique:subjects'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }
        $code = $this->codeGenerate(Subject::class);
        Subject::create([
            'name' => $request->name,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Предмет был успешно добавлен',
            'errors' => $val->errors()], 200);
    }

    public function editSubject (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $subject = Subject::where('code', '=', $request->code)->first();

        if(is_null($subject)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого предмета не существует',
                'errors' => $val->errors()], 422);
        }

        $subject->name = $request->name;

        $subject->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Предмет был успешно отредактирован',
            'errors' => $val->errors()], 200);
    }

    public function deleteSubject (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $subject = Subject::where('code', '=', $request->code)->first();

        if(is_null($subject)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого предмета не существует',
                'errors' => $val->errors()], 422);
        }

        $subject->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Предмет был успешно удалён',
            'errors' => $val->errors()], 200);
    }
}
