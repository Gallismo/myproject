<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function addNewGroup(Request $request) {
        $val = Validator::make($request->all(), [
            'group_name' => 'required|string|unique:groups',
            'department' => 'required|string',
            'start_year' => 'required|string|min:4|max:4'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $val = Validator::make($request->all(), [
            'start_year' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        if (!$request->department=='technology' || !$request->department=='economic') {
            return response()->json(['error'=>['code'=>'422', 'errors'=>'Choose excepted department']], 422);
        }

        Group::create([
            'group_name' => $request->group_name,
            'department' => $request->department,
            'start_year' => $request->start_year
        ]);

        return response()->json('Group has been created', 200);
    }

    public function deleteGroup(Request $request) {
        $val = Validator::make($request->all(), [
            'group_name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $group = Group::where('group_name', '=', $request->group_name)->first();

        if (is_null($group)) {
            return response()->json('Group does not exist already', 422);
        }

        $group->delete();

        return response()->json('Group has been deleted', 200);
    }
}
