<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentFormRequest;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function createDepartment (DepartmentFormRequest $req) {
        $request = $req->validated();

        $code = $this->codeGenerate(Department::class);
        Department::create([
            'name' => $request['name'],
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Отделение было успешно добавлено',
            'errors' => new \stdClass()], 200);
    }

    public function editDepartment (DepartmentFormRequest $req) {
        $request = $req->validated();

        $department = Department::where('code', '=', $request['code'])->first();
        $department->name = $request['name'];
        $department->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Отделение было успешно отредактировано',
            'errors' => new \stdClass()], 200);
    }

    public function deleteDepartment (DepartmentFormRequest $req) {
        $request = $req->validated();

        $department = Department::where('code', '=', $request['code'])->first();
        $department->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Отделение было успешно удалено',
            'errors' => new \stdClass()], 200);
    }
}
