<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function createTeacher (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'surname' => 'required|string',
            'middle_name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        Teacher::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'middle_name' => $request->middle_name
        ]);

        return response()->json(['response' => 'Teacher has been created'], 200);
    }

    public function editTeacher (Request $request, $id) {
        $val = Validator::make($request->all(), [
            'name' => 'string|required_without_all:surname,middle_name',
            'surname' => 'required_without_all:name,middle_name|string',
            'middle_name' => 'required_without_all:name,surname|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $teacher = Teacher::where('id', $id)->first();

        if (is_null($teacher)) {
            return response()->json(['response' => 'Teacher does not exist'], 422);
        }

        $request->name ? $teacher->name=$request->name : false;
        $request->surname ? $teacher->surname=$request->surname : false;
        $request->middle_name ? $teacher->middle_name=$request->middle_name : false;

        $teacher->save();

        return response()->json(['response' => 'Teacher has been edited'], 200);
    }

    public function deleteTeacher (Request $request, $id) {
        $teacher = Teacher::where('id', $id)->first();

        if (is_null($teacher)) {
            return response()->json(['response' => 'Teacher does not exist already'], 422);
        }

        $teacher->delete();

        return response()->json(['response' => 'Teacher has been deleted'], 200);
    }
}
