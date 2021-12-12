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
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }
        $code = $this->codeGenerate(groupsPart::class);
        groupsPart::create([
            'groups_part' => $request->groups_part,
            'code' => $code
        ]);

        return response()->json(['response' => 'Group part has been created'], 200);
    }

    public function editGroupsPart (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string',
            'groups_part' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $groupsPart = groupsPart::where('code', '=', $request->code)->first();

        if(is_null($groupsPart)) {
            return response()->json(['response' => 'Group part does not exist'], 422);
        }

        $groupsPart->groups_part = $request->groups_part;

        $groupsPart->save();

        return response()->json(['response' => 'Group part has been edited'], 200);
    }

    public function deleteGroupsPart (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $groupsPart = groupsPart::where('code', '=', $request->code)->first();

        if(is_null($groupsPart)) {
            return response()->json(['response' => 'Group part does not exist already'], 422);
        }

        $groupsPart->delete();

        return response()->json(['response' => 'Group part has been deleted'], 200);
    }
}
