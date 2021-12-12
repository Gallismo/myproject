<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\lessonsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonsOrdersController extends Controller
{
    public function createLessonsOrder (Request $request) {
        $val = Validator::make($request->all(), [
            'lessons_order' => 'required|string|unique:lessons_orders'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }
        $code = $this->codeGenerate(lessonsOrder::class);
        lessonsOrder::create([
            'lessons_order' => $request->lessons_order,
            'code' => $code
        ]);

        return response()->json(['response' => 'Lessons order has been created'], 200);
    }

    public function editLessonsOrder (Request $request) {
        $val = Validator::make($request->all(), [
            'lessons_order' => 'required|string',
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $lessonsOrder = lessonsOrder::where('code', '=', $request->code)->first();

        if(is_null($lessonsOrder)) {
            return response()->json(['response' => 'Lessons order does not exist'], 422);
        }

        $lessonsOrder->lessons_order = $request->lessons_order;

        $lessonsOrder->save();

        return response()->json(['response' => 'Lessons order has been edited'], 200);
    }

    public function deleteLessonsOrder (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $lessonsOrder = lessonsOrder::where('code', '=', $request->code)->first();

        if(is_null($lessonsOrder)) {
            return response()->json(['response' => 'Lessons order does not exist already'], 422);
        }

        $lessonsOrder->delete();

        return response()->json(['response' => 'Lessons order has been deleted'], 200);
    }
}
