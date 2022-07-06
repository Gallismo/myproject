<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupFormRequest;
use App\Models\Department;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function createGroup (GroupFormRequest $req) {
        $request = $req->validated();

        $val = Validator::make($request, [
            'start_year' => 'integer',
            'end_year' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $department = Department::where('code', $request['department_code'])->first();

        $code = $this->codeGenerate(Group::class);
        Group::create([
            'name' => $request['name'],
            'department_id' => $department['id'],
            'start_year' => $request['start_year'],
            'end_year' => $request['end_year'],
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно добавлена',
            'errors' => new \stdClass()], 200);
    }

    public function deleteGroup (GroupFormRequest $req) {
        $request = $req->validated();

        $group = Group::where('code', $request['code'])->first();

        $group->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно удалена',
            'errors' => new \stdClass()], 200);
    }

    public function editGroup (GroupFormRequest $req) {
        $request = $req->validated();

        $val = Validator::make($request, [
            'start_year' => 'integer',
            'end_year' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $group = Group::where('code', $request['code'])->first();

        if (isset($request['department_code'])) {
            $department = Department::where('code', $request['department_code'])->first();
            $group->department_id = $department->id;
        }

        isset($request['name']) ? $group->name = $request['name'] : false;
        isset($request['start_year']) ? $group->start_year = $request['start_year'] : false;
        isset($request['end_year']) ? $group->end_year = $request['end_year'] : false;

        $group->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно отредактирована',
            'errors' => $val->errors()], 200);
    }
}
