<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\groupsPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupsPartsController extends Controller
{
    public function createGroupsPart (Request $request) {
        $val = Validator::make($request->all(), [
            'groups_part' => 'required|string|unique:groups_parts'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }
        $code = $this->codeGenerate(groupsPart::class);
        groupsPart::create([
            'groups_part' => $request->groups_part,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Раздел для групп был успешно добавлен',
            'errors' => $val->errors()], 200);
    }

    public function editGroupsPart (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string',
            'groups_part' => 'required|string|unique:groups_parts'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $groupsPart = groupsPart::where('code', '=', $request->code)->first();

        if(is_null($groupsPart)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого раздела групп не существует',
                'errors' => $val->errors()], 422);
        }

        $groupsPart->groups_part = $request->groups_part;

        $groupsPart->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Раздел групп был успешно отредактирован',
            'errors' => $val->errors()], 200);
    }

    public function deleteGroupsPart (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $groupsPart = groupsPart::where('code', '=', $request->code)->first();

        if(is_null($groupsPart)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого раздела групп не существует',
                'errors' => $val->errors()], 422);
        }

        $groupsPart->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Раздел групп был успешно удален',
            'errors' => $val->errors()], 200);
    }
}
