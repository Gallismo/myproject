<?php

namespace App\Http\Controllers;

use App\Models\lessonsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonsOrdersController extends Controller
{
    public function createLessonsOrder (Request $request) {
        $val = Validator::make($request->all(), [
            'lessons_order' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        lessonsOrder::create([
            'lessons_order' => $request->lessons_order
        ]);

        return response()->json(['response' => 'Lessons order has been created'], 200);
    }

    public function editLessonsOrder (Request $request) {
        $val = Validator::make($request->all(), [
            'lessons_order' => 'required|string',
            'lessons_order_new' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $lessonsOrder = lessonsOrder::where('lessons_order', '=', $request->lessons_order)->first();

        if(is_null($lessonsOrder)) {
            return response()->json(['response' => 'Lessons order does not exist'], 422);
        }

        $lessonsOrder->lessons_order = $request->lessons_order_new;

        $lessonsOrder->save();

        return response()->json(['response' => 'Lessons order has been edited'], 200);
    }

    public function deleteLessonsOrder (Request $request) {
        $val = Validator::make($request->all(), [
            'lessons_order' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $lessonsOrder = lessonsOrder::where('lessons_order', '=', $request->lessons_order)->first();

        if(is_null($lessonsOrder)) {
            return response()->json(['response' => 'Lessons order does not exist already'], 422);
        }

        $lessonsOrder->delete();

        return response()->json(['response' => 'Lessons order has been deleted'], 200);
    }
}
