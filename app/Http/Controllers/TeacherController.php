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
            'name' => 'required|string|min:1',
            'surname' => 'required|string|min:1',
            'middle_name' => 'required|string|min:1',
            'user_id' => 'required|exists:users,id'
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
            'user_id' => $request->user_id,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Преподаватель был успешно добавлен',
            'errors' => $val->errors()], 200);
    }

    public function editTeacher (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'string|required_without_all:surname,middle_name,user_id|min:1',
            'surname' => 'required_without_all:name,middle_name,user_id|string|min:1',
            'middle_name' => 'required_without_all:name,surname,user_id|string|min:1',
            'user_id' => 'required_without_all:name,surname,middle_name|integer|exists:users,id|unique:teachers,user_id',
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
        $request->user_id ? $teacher->user_id=$request->user_id : false;

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
