<?php

namespace App\Http\Controllers;

use App\Models\groupsBooking;
use App\Models\lessonsBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonsBookingsController extends Controller
{
    public function createLessonBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'lesson_date' => 'required|date-format:Y-m-d',
            'lesson_order_id' => 'required|exists:lessons_orders,id|integer',
            'audience_id' => 'required|exists:audiences,id|integer',
            'subject_id' => 'required|exists:subjects,id|integer',
            'teacher_id' => 'required|exists:teachers,id|integer',
            'is_remote' => 'boolean'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        if (is_null($request->is_remote)) {
            $request->is_remote = false;
        }

        $lessonCheck = lessonsBooking::where('lesson_date', $request->lesson_date)
                                    ->where('lesson_order_id', $request->lesson_order_id)
                                    ->where('audience_id', $request->audience_id)->first();

        if (!is_null($lessonCheck)) {
            return response()->json(['error'=>['code'=>'422',
                'errors'=>'Audience is engaged', 'by' => $lessonCheck]], 422);
        }

        $teacherArr = [];
        $teacherCheck = lessonsBooking::where('lesson_date', $request->lesson_date)
            ->where('lesson_order_id', $request->lesson_order_id)
            ->where('teacher_id', $request->teacher_id)->get();

        foreach ($teacherCheck as $item) {
            $teacherArr[] = $item;
        }

        if (array_key_exists(0, $teacherArr)) {
            echo json_encode(['warning'=>[
                'message'=>'Teacher is engaged', 'by' => $teacherArr]])."\n";
        }

        lessonsBooking::create([
            'lesson_date' => $request->lesson_date,
            'lesson_order_id' => $request->lesson_order_id,
            'audience_id' => $request->audience_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'is_remote' => $request->is_remote
        ]);

        return response()->json(['response' => 'Lesson Booking has been created'], 200);
    }

    public function deleteLessonBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'id' => 'required|exists:lessons_bookings,id'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $lessonBooking = lessonsBooking::find($request->id)->first();

        if (is_null($lessonBooking)) {
            return response()->json(['response' => 'Lesson Booking doesnt exist'], 422);
        }

        $groupArr = [];
        $groupBookingCheck = groupsBooking::where('booking_id', $lessonBooking->id)->get();

        foreach ($groupBookingCheck as $item) {
            $groupArr[] = $item;
        }

        if (array_key_exists(0, $groupArr)) {
            echo json_encode(['warning'=>[
                    'message'=>'Deleting also groups that references on booking', 'groups bookings' => $groupArr]])."\n";
        }

        $lessonBooking->delete();

        return response()->json(['response' => 'Lesson Booking has been deleted'], 200);
    }

    public function editLessonBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'id' => 'required|exists:lessons_bookings,id|integer',
            'lesson_date' => 'required_without_all:lesson_order_id,audience_id,subject_id,teacher_id,is_remote|date-format:Y-m-d',
            'lesson_order_id' => 'required_without_all:lesson_date,audience_id,subject_id,teacher_id,is_remote|exists:lessons_orders,id|integer',
            'audience_id' => 'required_without_all:lesson_date,lesson_order_id,subject_id,teacher_id,is_remote|exists:audiences,id|integer',
            'subject_id' => 'required_without_all:lesson_date,lesson_order_id,audience_id,teacher_id,is_remote|exists:subjects,id|integer',
            'teacher_id' => 'required_without_all:lesson_date,lesson_order_id,audience_id,subject_id,is_remote|exists:teachers,id|integer',
            'is_remote' => 'boolean|required_without_all:lesson_date,lesson_order_id,audience_id,subject_id,teacher_id'
        ]);

        if ($val->fails()) {
            return response()->json(['error'=>['code'=>'422', 'errors'=>$val->errors()]], 422);
        }

        $lessonCheck = lessonsBooking::where('lesson_date', $request->lesson_date)
            ->where('lesson_order_id', $request->lesson_order_id)
            ->where('audience_id', $request->audience_id)->first();

        if (!is_null($lessonCheck)) {
            return response()->json(['error'=>['code'=>'422',
                'errors'=>'Audience is engaged', 'by' => $lessonCheck]], 422);
        }

        $lessonBooking = lessonsBooking::find($request->id);

        $request->lesson_date ? $lessonBooking->lesson_date = $request->lesson_date : false;
        $request->lesson_order_id ? $lessonBooking->lesson_order_id = $request->lesson_order_id : false;
        $request->audience_id ? $lessonBooking->audience_id = $request->audience_id : false;
        $request->subject_id ? $lessonBooking->subject_id = $request->subject_id : false;
        $request->teacher_id ? $lessonBooking->teacher_id = $request->teacher_id : false;
        $request->is_remote ? $lessonBooking->is_remote = $request->is_remote : false;

        $teacherArr = [];
        $teacherCheck = lessonsBooking::where('lesson_date', $lessonBooking->lesson_date)
            ->where('lesson_order_id', $lessonBooking->lesson_order_id)
            ->where('teacher_id', $lessonBooking->teacher_id)->get();

        foreach ($teacherCheck as $item) {
            if ($item->id === $lessonBooking->id) {
                continue;
            }
            $teacherArr[] = $item;
        }

        if (array_key_exists(0, $teacherArr)) {
            echo json_encode(['warning'=>[
                    'message'=>'Teacher is engaged', 'by' => $teacherArr]])."\n";
        }

        $lessonBooking->save();

        return response()->json(['response' => 'Lesson Booking has been edited'], 200);
    }
}
