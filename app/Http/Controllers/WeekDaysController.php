<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\weekDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeekDaysController extends Controller
{
    public function createWeekDay (Request $request) {
        $val = Validator::make($request->all(), [
            'week_day' => 'required|string|unique:week_days'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }
        $code = $this->codeGenerate(weekDay::class);
        weekDay::create([
            'week_day' => $request->week_day,
            'code' => $code
        ]);

        return response()->json(['response' => 'Week Day has been created'], 200);
    }

    public function editWeekDay (Request $request) {
        $val = Validator::make($request->all(), [
            'week_day' => 'required|string',
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $weekDay = weekDay::where('code', '=', $request->code)->first();

        if(is_null($weekDay)) {
            return response()->json(['response' => 'Week Day does not exist'], 422);
        }

        $weekDay->week_day = $request->week_day;

        $weekDay->save();

        return response()->json(['response' => 'Week Day has been edited'], 200);
    }

    public function deleteWeekDay (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $weekDay = weekDay::where('code', '=', $request->code)->first();

        if(is_null($weekDay)) {
            return response()->json(['response' => 'Week Day does not exist already'], 422);
        }

        $weekDay->delete();

        return response()->json(['response' => 'Week Day has been deleted'], 200);
    }
}
