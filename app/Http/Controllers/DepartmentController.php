<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function createDepartment (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string|unique:departments'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }
        $code = $this->codeGenerate(Department::class);
        Department::create([
            'name' => $request->name,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Отделение было успешно добавлено',
            'errors' => $val->errors()], 200);
    }

    public function editDepartment (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $department = Department::where('code', '=', $request->code)->first();

        if(is_null($department)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Отделение не существует',
                'errors' => $val->errors()], 422);
        }

        $department->name = $request->name;

        $department->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Отделение было успешно отредактировано',
            'errors' => $val->errors()], 200);
    }

    public function deleteDepartment (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $department = Department::where('code', '=', $request->code)->first();

        if(is_null($department)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Отделение не существует',
                'errors' => $val->errors()], 422);
        }

        $department->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Отделение было успешно удалено',
            'errors' => $val->errors()], 200);
    }
}
