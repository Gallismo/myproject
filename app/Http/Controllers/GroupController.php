<?php

namespace App\Http\Controllers;

use App\Contracts\ErrorResponseContract;
use App\Contracts\FindByCodeContract;
use App\Contracts\ResponeContract;
use App\Http\Requests\GroupFormRequest;
use App\Models\Department;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{

    public function createGroup (GroupFormRequest $req, FindByCodeContract $findByCode,
                                 ResponeContract $sendResp, ErrorResponseContract $sendError): JsonResponse
    {
        $request = $req->validated();

        if (!$this->isValidYears($request)) {
            return $sendError('Ошибка валидации', 'Проверьте правильность заполнения полей', $this->val, 422);
        }

        $department = $findByCode($request['department_code'], new Department);

        $group = Group::create([
            'name' => $request['name'],
            'department_id' => $department['id'],
            'start_year' => $request['start_year'],
            'end_year' => $request['end_year'],
            'code' => $this->codeGenerate(new Group)
        ]);

        return $sendResp('Успешно', 'Группа была успешно добавлена', 200);
    }

    public function deleteGroup (GroupFormRequest $req, FindByCodeContract $findByCode,
                                 ResponeContract $sendResp) :JsonResponse
    {
        $request = $req->validated();

        $group = $findByCode($request['code'], new Group);

        $group->delete();

        return $sendResp('Успешно', 'Группа была успешно удалена', 200);
    }

    public function editGroup (GroupFormRequest $req, FindByCodeContract $findByCode,
                               ErrorResponseContract $sendError, ResponeContract $sendResp): JsonResponse
    {
        $request = $req->validated();

        if (!$this->isValidYears($request)) {
            return $sendError('Ошибка валидации', 'Проверьте правильность заполнения полей', $this->val, 422);
        }

        $group = $findByCode($request['code'], new Group);

        if (isset($request['department_code'])) {
            $department = $findByCode($request['department_code'], new Department);
            $group->department_id = $department->id;
        }

        isset($request['name']) ? $group->name = $request['name'] : false;
        isset($request['start_year']) ? $group->start_year = $request['start_year'] : false;
        isset($request['end_year']) ? $group->end_year = $request['end_year'] : false;

        $group->save();

        return $sendResp('Успешно', 'Группа была успешно отредактирована', 200);
    }

    private function isValidYears(array $request): bool
    {
        $this->val = Validator::make($request, [
            'start_year' => 'integer',
            'end_year' => 'integer'
        ]);

        if ($this->val->fails()) {
            return false;
        }

        return true;
    }
}
