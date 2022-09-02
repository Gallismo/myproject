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
    private $val;

    public function createGroup (GroupFormRequest $req, ResponeContract $sendResp,
                                 ErrorResponseContract $sendError): JsonResponse
    {
        $request = $req->validated();

        if (!$this->isValidYears($request)) {
            return $sendError('Ошибка валидации', 'Проверьте правильность заполнения полей', $this->val, 422);
        }

        Group::create([
            'name' => $request['name'],
            'department_id' => $request['department_id'],
            'start_year' => $request['start_year'],
            'end_year' => $request['end_year']
        ]);

        return $sendResp('Успешно', 'Группа была успешно добавлена', 200);
    }

    public function deleteGroup (GroupFormRequest $req, ResponeContract $sendResp) :JsonResponse
    {
        $request = $req->validated();

        $group = Group::find($request['id']);
        $group->delete();

        return $sendResp('Успешно', 'Группа была успешно удалена', 200);
    }

    public function editGroup (GroupFormRequest $req, ErrorResponseContract $sendError,
                               ResponeContract $sendResp): JsonResponse
    {
        $request = $req->validated();

        if (!$this->isValidYears($request)) {
            return $sendError('Ошибка валидации', 'Проверьте правильность заполнения полей', $this->val, 422);
        }

        $group = Group::find($request['id']);

        $group->department_id = $request['department_id'] ?? $group->department_id;
        $group->name = $request['name'] ?? $group->name;
        $group->start_year = $request['start_year'] ?? $group->start_year;
        $group->end_year = $request['end_year'] ?? $group->end_year;

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
