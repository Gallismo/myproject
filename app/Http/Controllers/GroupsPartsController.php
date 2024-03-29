<?php

namespace App\Http\Controllers;

use App\Contracts\ResponeContract;
use App\Http\Requests\Admin\GroupsPartsRequest;
use App\Models\Audience;
use App\Models\groupsPart;
use Illuminate\Http\JsonResponse;

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

        return $this->deleteSomething(new groupsPart(), $request['id'],
            $this->sendResp('Успешно', 'Раздел групп был успешно удален', 200));
    }
}
