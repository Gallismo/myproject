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
    public function createDepartment (DepartmentFormRequest $req,  ResponeContract $sendResp): JsonResponse
    {
        $request = $req->validated();

        Department::create([
            'name' => $request['name'],
            'code' => $this->codeGenerate(new Department)
        ]);

        return $sendResp('Успешно', 'Отделение было успешно добавлено', 200);
    }

    public function editDepartment (DepartmentFormRequest $req, FindByCodeContract $findByCode,
                                    ResponeContract $sendResp): JsonResponse
    {
        $request = $req->validated();

        $department = $findByCode($request['code'], new Department);
        $department->name = $request['name'];
        $department->save();

        return $sendResp('Успешно', 'Отделение было успешно отредактировано', 200);
    }

    public function deleteDepartment (DepartmentFormRequest $req, FindByCodeContract $findByCode,
                                      ResponeContract $sendResp): JsonResponse
    {
        $request = $req->validated();

        $department = $findByCode($request['code'], new Department);
        $department->delete();

        return $sendResp('Успешно', 'Отделение было успешно удалено', 200);
    }
}
