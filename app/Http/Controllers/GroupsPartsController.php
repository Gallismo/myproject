<?php

namespace App\Http\Controllers;

use App\Contracts\ResponeContract;
use App\Http\Requests\GroupsPartsRequest;
use App\Models\Group;
use App\Models\groupsPart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupsPartsController extends Controller
{
    public function createGroupsPart (GroupsPartsRequest $request): JsonResponse
    {
        $request = $request->validated();

        groupsPart::create([
            'name' => $request['name']
        ]);

        return $this->sendResp('Успешно', 'Раздел для групп был успешно добавлен', 200);
    }

    public function editGroupsPart (GroupsPartsRequest $request): JsonResponse
    {
        $request = $request->validated();

        $groupsPart = groupsPart::find($request['id']);
        $groupsPart->name = $request['name'];

        $groupsPart->save();

        return $this->sendResp('Успешно', 'Раздел групп был успешно отредактирован', 200);
    }

    public function deleteGroupsPart (GroupsPartsRequest $request): JsonResponse
    {
        $request = $request->validated();

        $groupsPart = groupsPart::find($request['id']);
        $groupsPart->delete();

        return $this->sendResp('Успешно', 'Раздел групп был успешно удален', 200);
    }
}
