<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function createGroup (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|unique:groups|string|max:14',
            'department_code' => 'required|string',
            'start_year' => 'required|string|min:4|max:4',
            'end_year' => 'required|string|min:4|max:4'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $val = Validator::make($request->all(), [
            'start_year' => 'integer',
            'end_year' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $department = Department::where('code', $request->department_code)->first();

        if (!$department) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такое отделение не существует',
                'errors' => $val->errors()], 422);
        }
        $code = $this->codeGenerate(Group::class);
        Group::create([
            'name' => $request->name,
            'department_id' => $department->id,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно добавлена',
            'errors' => $val->errors()], 200);
    }

    public function deleteGroup (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $group = Group::where('code', $request->code)->first();

        if (!$group) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Группа не существует',
                'errors' => $val->errors()], 422);
        }

        $group->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно удалена',
            'errors' => $val->errors()], 200);
    }

    public function editGroup (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required_without_all:start_year,end_year,department_code|string|unique:groups,name|max:14',
            'department_code' => 'required_without_all:start_year,end_year,name|string',
            'start_year' => 'required_without_all:department_code,end_year,name|string|min:4|max:4',
            'end_year' => 'required_without_all:start_year,department_code,name|string|min:4|max:4'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $val = Validator::make($request->all(), [
            'start_year' => 'integer',
            'end_year' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $group = Group::where('code', $request->code)->first();

        if (!$group) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Группа не существует',
                'errors' => $val->errors()], 422);
        }
        if ($request->department_code) {
            $department = Department::where('code', $request->department_code)->first();
            if (!$department) {
                return response()->json(['title' => 'Ошибка',
                    'text' => 'Такого отделения не существует',
                    'errors' => $val->errors()], 422);
            }
            $group->department_id = $department->id;
        }

        $request->name ? $group->name = $request->name : false;
        $request->start_year ? $group->start_year = $request->start_year : false;
        $request->end_year ? $group->end_year = $request->end_year : false;

        $group->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно отредактирована',
            'errors' => $val->errors()], 200);
    }
}
