<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function createGroup (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|unique:groups|string',
            'department_id' => 'required|integer',
            'start_year' => 'required|string|min:4|max:4',
            'end_year' => 'required|string|min:4|max:4'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $val = Validator::make($request->all(), [
            'start_year' => 'integer',
            'end_year' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $department = Department::find($request->department_id);

        if (!$department) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>['Department' => 'Department doesnt exist']]], 422);
        }
        $code = $this->codeGenerate(Group::class);
        Group::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
            'code' => $code
        ]);

        return response()->json(['response' => 'Group has been created'], 200);
    }

    public function deleteGroup (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $group = Group::where('name', $request->name)->first();

        if (!$group) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>['Group' => 'Group doesnt exist']]], 422);
        }

        $group->delete();

        return response()->json(['response' => 'Group has been deleted'], 200);
    }

    public function editGroup (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'department_id' => 'required_without_all:start_year,end_year|integer',
            'start_year' => 'required_without_all:department_id,end_year|string|min:4|max:4',
            'end_year' => 'required_without_all:start_year,department_id|string|min:4|max:4'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $val = Validator::make($request->all(), [
            'start_year' => 'integer',
            'end_year' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $group = Group::where('name', $request->name)->first();

        if (!$group) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>['Group' => 'Group doesnt exist']]], 422);
        }

        if ($request->department_id) {
            $department = Department::find($request->department_id);
            if (!$department) {
                return response()->json(['error'=>['code'=>'422', 'errors'=>['Department' => 'Department doesnt exist']]], 422);
            }
            $group->department_id = $request->department_id;
        }

        $request->start_year ? $group->start_year = $request->start_year : false;
        $request->end_year ? $group->end_year = $request->end_year : false;

        $group->save();

        return response()->json(['response' => 'Group has been edited'], 200);
    }
}
