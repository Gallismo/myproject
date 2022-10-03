<?php

namespace App\Http\Controllers;

use App\Contracts\ResponeContract;
use App\Http\Requests\Admin\GroupsBookingsRequest;
use App\Models\Audience;
use App\Models\groupsBooking;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

class GroupsBookingsController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/groupBooking",
     *     description="Добавить группу к паре",
     *     tags={"Group"},
     *     @OA\RequestBody(
     *          description="Тело запроса для добавления группы в пару",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"booking_id", "group_id", "group_part_id",},
     *              @OA\Property(property="booking_id", type="integer", example="1", description="ID пары"),
     *              @OA\Property(property="group_id", type="integer", example="1", description="ID группы"),
     *              @OA\Property(property="group_part_id", type="integer", example="1", description="ID подгруппы"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Группа добавлена на пару",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessRespone")
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Валидация не пройдена",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/ErrorResponse",
    )
     *     )
     * )
     */
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

    /**
     * @OA\Patch(
     *     path="/api/groupBooking",
     *     description="Отредактировать группу в паре",
     *     tags={"Group"},
     *     @OA\RequestBody(
     *          description="Тело запроса для редактирования группы в паре",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1", description="ID добавления группы"),
     *              @OA\Property(property="booking_id", type="integer", example="1", description="ID пары"),
     *              @OA\Property(property="group_id", type="integer", example="1", description="ID группы"),
     *              @OA\Property(property="group_part_id", type="integer", example="1", description="ID подгруппы"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Группа на паре отредактирована",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessRespone")
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Валидация не пройдена",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/ErrorResponse",
    )
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/groupBooking",
     *     description="Удалить группу с пары",
     *     tags={"Group"},
     *     @OA\RequestBody(
     *          description="Тело запроса для удаления группы в паре",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1", description="ID добавления группы"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Группа на паре удалена",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessRespone")
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Валидация не пройдена",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/ErrorResponse",
    )
     *     )
     * )
     */
    public function deleteGroupBooking (GroupsBookingsRequest $request): JsonResponse
    {
        $request = $request->validated();

        return $this->deleteSomething(new groupsBooking(), $request['id'],
            $this->sendResp('Успешно', 'Группа была успешно удалена с пары', 200));
    }
}
