<?php

namespace App\Http\Controllers;

use App\Contracts\ErrorResponseContract;
use App\Contracts\ResponeContract;
use App\Http\Requests\GroupsBookingsRequest;
use App\Models\groupsBooking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class GroupsBookingsController extends Controller
{
    public function createGroupBooking (GroupsBookingsRequest $request): JsonResponse
    {
        $request = $request->validated();

        $groupBookingCheck = groupsBooking::where('booking_id', $request['booking_id'])
            ->where('group_id', $request['group_id'])->first();

        if (!is_null($groupBookingCheck)) {
            return $this->sendError('Ошибка', 'Такая группа уже была добавлена на пару', Validator::make([], []), 422);
        }

        groupsBooking::create([
            'booking_id' => $request['booking_id'],
            'group_id' => $request['group_id'],
            'group_part_id' => $request['group_part_id']
        ]);

        return $this->sendResp('Успешно', 'Группа была успешно добавлена на пару', 200);
    }

    public function editGroupBooking (GroupsBookingsRequest $request): JsonResponse
    {
        $request = $request->validated();

        $groupBookingCheck = groupsBooking::where('booking_id', $request['booking_id'])
            ->where('group_id', $request['group_id'])->first();

        if (!is_null($groupBookingCheck)) {
            return $this->sendError('Ошибка', 'Такая группа уже была добавлена на пару', Validator::make([], []), 422);
        }

        $groupBooking = groupsBooking::find($request['id']);

        $groupBooking->booking_id = $request['booking_id'] ?? $groupBooking->booking_id;
        $groupBooking->group_id = $request['group_id'] ?? $groupBooking->group_id;
        $groupBooking->group_part_id = $request['group_part_id'] ?? $groupBooking->group_part_id;

        $groupBooking->save();

        return $this->sendResp('Успешно', 'Группа была успешно изменена и добавлена', 200);
    }

    public function deleteGroupBooking (GroupsBookingsRequest $request): JsonResponse
    {
        $request = $request->validated();

        $groupBooking = groupsBooking::find($request['id']);
        $groupBooking->delete();

        return $this->sendResp('Успешно', 'Группа была успешно удалена с пары', 200);
    }
}
