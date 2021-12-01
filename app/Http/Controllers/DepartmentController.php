<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function createDepartment (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string|unique:departments'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        Department::create([
            'name' => $request->name
        ]);

        return response()->json(['response' => 'Department has been created'], 200);
    }

    public function editDepartment (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'name_new' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $department = Department::where('name', '=', $request->name)->first();

        if(is_null($department)) {
            return response()->json(['response' => 'Department does not exist'], 422);
        }

        $department->name = $request->name_new;

        $department->save();

        return response()->json(['response' => 'Department has been edited'], 200);
    }

    public function deleteDepartment (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $department = Department::where('name', '=', $request->name)->first();

        if(is_null($department)) {
            return response()->json(['response' => 'Department does not exist already'], 422);
        }

        $department->delete();

        return response()->json(['response' => 'Department has been deleted'], 200);
    }
}
