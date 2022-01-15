<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function createTeacher (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'surname' => 'required|string',
            'middle_name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $code = $this->codeGenerate(Teacher::class);
        Teacher::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'middle_name' => $request->middle_name,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Преподаватель был успешно добавлен',
            'errors' => $val->errors()], 200);
    }

    public function editTeacher (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'string|required_without_all:surname,middle_name',
            'surname' => 'required_without_all:name,middle_name|string',
            'middle_name' => 'required_without_all:name,surname|string',
            'code' => 'required|string|exists:teachers,code'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $teacher = Teacher::where('code', $request->code)->first();

        if (is_null($teacher)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого преподавателя не существует',
                'errors' => $val->errors()], 422);
        }

        $request->name ? $teacher->name=$request->name : false;
        $request->surname ? $teacher->surname=$request->surname : false;
        $request->middle_name ? $teacher->middle_name=$request->middle_name : false;

        $teacher->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Преподаватель был успешно отредактирован',
            'errors' => $val->errors()], 200);
    }

    public function deleteTeacher (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string|exists:teachers,code'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $teacher = Teacher::where('code', $request->code)->first();

        if (is_null($teacher)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого преподавателя не существует',
                'errors' => $val->errors()], 422);
        }

        $teacher->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Преподаватель был успешно удалён',
            'errors' => $val->errors()], 200);
    }
}
