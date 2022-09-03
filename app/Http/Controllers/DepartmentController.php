<?php

namespace App\Http\Controllers;

use App\Contracts\FindByCodeContract;
use App\Contracts\ResponeContract;
use App\Http\Requests\DepartmentFormRequest;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function createDepartment (DepartmentFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        Department::create([
            'name' => $request['name']
        ]);

        return $this->sendResp('Успешно', 'Отделение было успешно добавлено', 200);
    }

    public function editDepartment (DepartmentFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $department = Department::find($request['id']);
        $department->name = $request['name'];
        $department->save();

        return $this->sendResp('Успешно', 'Отделение было успешно отредактировано', 200);
    }

    public function deleteDepartment (DepartmentFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $department = Department::find($request['id']);
        $department->delete();

        return $this->sendResp('Успешно', 'Отделение было успешно удалено', 200);
    }
}
