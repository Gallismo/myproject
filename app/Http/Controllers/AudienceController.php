<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudienceController extends Controller
{
    public function addNewAudience(Request $request) {
        $val = Validator::make($request->all(), [
           'audience_name' => 'required|string|max:2|min:2|unique:audiences'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $val = Validator::make($request->all(), [
            'audience_name' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        Audience::create([
            'audience_name' => $request->audience_name
        ]);

        return response()->json('Audience has been created', 200);
    }

    public function deleteAudience(Request $request) {
        $val = Validator::make($request->all(), [
            'audience_name' => 'required|string|max:2|min:2'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $val = Validator::make($request->all(), [
            'audience_name' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $audience = Audience::where('audience_name', '=', $request->audience_name)->first();

        if (is_null($audience)) {
            return response()->json('Audience does not exist already', 422);
        }

        $audience->delete();

        return response()->json('Audience has been deleted', 200);
    }
}
