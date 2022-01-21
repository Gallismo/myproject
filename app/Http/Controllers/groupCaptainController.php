<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\groupCaptain;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class groupCaptainController extends Controller
{
    public function create (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string|min:1',
            'user_id' => 'required|exists:users,id|unique:group_captains,user_id',
            'group_code' => 'required|exists:groups,code'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $group = Group::where('code', $request->group_code)->first();

        $code = $this->codeGenerate(groupCaptain::class);
        groupCaptain::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'group_id' => $group->id,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Староста был успешно добавлен',
            'errors' => $val->errors()], 200);
    }

    public function edit (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'string|required_without_all:user_id,group_id|min:1',
            'user_id' => 'required_without_all:name,group_id|integer|exists:users,id|unique:group_captains,user_id',
            'group_code' => 'required_without_all:name,user_id|exists:groups,code',
            'code' => 'required|string|exists:group_captains,code'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $captain = groupCaptain::where('code', $request->code)->first();

        if (is_null($captain)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого старосты не существует',
                'errors' => $val->errors()], 422);
        }

        if (isset($request->group_code)) {
            $group = Group::where('code', $request->group_code)->first();
            $captain->group_id = $group->id;
        }

        $request->name ? $captain->name=$request->name : false;
        $request->user_id ? $captain->user_id=$request->user_id : false;

        $captain->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Староста был успешно отредактирован',
            'errors' => $val->errors()], 200);
    }

    public function delete (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string|exists:group_captains,code'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $captain = groupCaptain::where('code', $request->code)->first();

        if (is_null($captain)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого преподавателя не существует',
                'errors' => $val->errors()], 422);
        }

        $captain->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Староста был успешно удалён',
            'errors' => $val->errors()], 200);
    }
}
