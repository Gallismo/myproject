<?php

namespace App\Http\Controllers;

use App\Contracts\ResponeContract;
use App\Http\Requests\Admin\GroupFormRequest;
use App\Models\Audience;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class GroupController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/Group",
     *     description="Создать группу",
     *     tags={"Group"},
     *     @OA\RequestBody(
     *          description="Тело запроса для создания группы",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "department_id", "start_year", "end_year"},
     *              @OA\Property(property="name", type="string", example="К-20-19", description="Название группы"),
     *              @OA\Property(property="department_id", type="integer", example="1", description="ID отделения"),
     *              @OA\Property(property="start_year", type="integer", example="2018", maxLength=4, minLength=4, description="Год поступления"),
     *              @OA\Property(property="end_year", type="integer", example="2022", maxLength=4, minLength=4, description="Год выпуска"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Группа создана",
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
    public function createGroup (GroupFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        Group::create([
            'name' => $request['name'],
            'department_id' => $request['department_id'],
            'start_year' => $request['start_year'],
            'end_year' => $request['end_year']
        ]);

        return $this->sendResp('Успешно', 'Группа была успешно добавлена', 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/Group",
     *     description="Удалить группу",
     *     tags={"Group"},
     *     @OA\RequestBody(
     *          description="Тело запроса для создания группы",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1", description="ID группы"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Группа удалена",
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
    public function deleteGroup (GroupFormRequest $req) :JsonResponse
    {
        $request = $req->validated();

        return $this->deleteSomething(new Group(), $request['id'],
            $this->sendResp('Успешно', 'Группа была успешно удалена', 200));
    }

    /**
     * @OA\Patch(
     *     path="/api/Group",
     *     description="Отредактировать группу",
     *     tags={"Group"},
     *     @OA\RequestBody(
     *          description="Тело запроса для редактирования группы",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1", description="ID группы"),
     *              @OA\Property(property="name", type="string", example="К-20-19", description="Название группы"),
     *              @OA\Property(property="department_id", type="integer", example="1", description="ID отделения"),
     *              @OA\Property(property="start_year", type="integer", example="2018", maxLength=4, minLength=4, description="Год поступления"),
     *              @OA\Property(property="end_year", type="integer", example="2022", maxLength=4, minLength=4, description="Год выпуска"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Группа отредактирована",
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
    public function editGroup (GroupFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $group = Group::find($request['id']);

        $group->department_id = $request['department_id'] ?? $group->department_id;
        $group->name = $request['name'] ?? $group->name;
        $group->start_year = $request['start_year'] ?? $group->start_year;
        $group->end_year = $request['end_year'] ?? $group->end_year;

        $group->save();

        return $this->sendResp('Успешно', 'Группа была успешно отредактирована', 200);
    }
}
