<?php

namespace App\Http\Controllers;

use App\Contracts\ResponeContract;
use App\Http\Requests\Admin\DepartmentFormRequest;
use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 *
 */
class DepartmentController extends Controller
{
    /**
     * @param DepartmentFormRequest $req
     * @return JsonResponse
     * @OA\Post(
     *     path="/api/Department",
     *     description="Добавить отделение",
     *     tags={"Department"},
     *     @OA\RequestBody(
     *          description="Тело запроса для создания отделения",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="Технологическое", description="Название отделения")
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Отделение добавлено",
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
    public function createDepartment (DepartmentFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        Department::create([
            'name' => $request['name']
        ]);

        return $this->sendResp('Успешно', 'Отделение было успешно добавлено', 200);
    }

    /**
     * @param DepartmentFormRequest $req
     * @return JsonResponse
     * @OA\Patch(
     *     path="/api/Department",
     *     description="Отредактировать отделение",
     *     tags={"Department"},
     *     @OA\RequestBody(
     *          description="Тело запроса для редактирования отделения",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "id"},
     *              @OA\Property(property="name", type="string", example="Технологическое", description="Название отделения"),
     *              @OA\Property(property="id", type="integer", example="1", description="ID отделения"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Отделение отредактировано",
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
    public function editDepartment (DepartmentFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $department = Department::find($request['id']);
        $department->name = $request['name'];
        $department->save();

        return $this->sendResp('Успешно', 'Отделение было успешно отредактировано', 200);
    }

    /**
     * @param DepartmentFormRequest $req
     * @return JsonResponse
     * @OA\Delete(
     *     path="/api/Department",
     *     description="Удалить отделение",
     *     tags={"Department"},
     *     @OA\RequestBody(
     *          description="Тело запроса для удаления отделения",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1", description="ID отделения"),
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Отделение удалено",
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
    public function deleteDepartment (DepartmentFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $department = Department::find($request['id']);
        $department->delete();

        return $this->sendResp('Успешно', 'Отделение было успешно удалено', 200);
    }
}
