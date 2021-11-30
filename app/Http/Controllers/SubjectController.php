<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function createSubject (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        Subject::create([
            'name' => $request->name
        ]);

        return response()->json(['response' => 'Subject has been created'], 200);
    }

    public function editSubject (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'name_new' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $subject = Subject::where('name', '=', $request->name)->first();

        if(is_null($subject)) {
            return response()->json(['response' => 'Subject does not exist'], 422);
        }

        $subject->name = $request->name_new;

        $subject->save();

        return response()->json(['response' => 'Subject has been edited'], 200);
    }

    public function deleteSubject (Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $subject = Subject::where('name', '=', $request->name)->first();

        if(is_null($subject)) {
            return response()->json(['response' => 'Subject does not exist already'], 422);
        }

        $subject->delete();

        return response()->json(['response' => 'Subject has been deleted'], 200);
    }
}
