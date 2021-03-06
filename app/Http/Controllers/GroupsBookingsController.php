<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\groupsBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupsBookingsController extends Controller
{
    public function createGroupBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'booking_id' => 'required|integer|exists:lessons_bookings,id',
            'group_id' => 'required|integer|exists:groups,id',
            'group_part_id' => 'required|integer|exists:groups_parts,id'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $groupBookingCheck = groupsBooking::where('booking_id', $request->booking_id)->where('group_id', $request->group_id)->first();

        if (!is_null($groupBookingCheck)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Группа уже была добавлена ранее на пару',
                'errors' => $val->errors()], 422);
        }
        $code = $this->codeGenerate(groupsBooking::class);
        groupsBooking::create([
            'code' => $code,
            'booking_id' => $request->booking_id,
            'group_id' => $request->group_id,
            'group_part_id' => $request->group_part_id
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно добавлена на пару',
            'errors' => $val->errors()], 200);
    }

    public function editGroupBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|integer|exists:groups_bookings,code',
            'booking_id' => 'required_without_all:group_part_id|integer|exists:lessons_bookings,id',
            'group_id' => 'required_without_all:group_part_id|integer|exists:groups,id',
            'group_part_id' => 'required_without_all:booking_id,group_id|integer|exists:groups_parts,id'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $groupBookingCheck = groupsBooking::where('booking_id', $request->booking_id)->where('group_id', $request->group_id)->first();

        if (!is_null($groupBookingCheck)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такая группа уже была добавлена на пару',
                'errors' => $val->errors()], 422);
        }

        $groupBooking = groupsBooking::where('code', $request->code)->first();

        $request->booking_id ? $groupBooking->booking_id = $request->booking_id : false;
        $request->group_id ? $groupBooking->group_id = $request->group_id : false;
        $request->group_part_id ? $groupBooking->group_part_id = $request->group_part_id : false;

        $groupBooking->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно изменена и добавлена',
            'errors' => $val->errors()], 200);
    }

    public function deleteGroupBooking (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|integer|exists:groups_bookings,code'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $groupBooking = groupsBooking::where('code', $request->code)->first();

        $groupBooking->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Группа была успешно удалена с пары',
            'errors' => $val->errors()], 200);
    }
}
