<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AudienceFormRequest;
use App\Models\Audience;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class AudienceController extends Controller
{

    /**
     * @param AudienceFormRequest $req
     * @return JsonResponse
     * @OA\Post(
     *     path="/api/Audience",
     *     description="Добавить аудиторию",
     *     tags={"Audience"},
     *     @OA\RequestBody(
     *          description="Тело запроса для создания аудитории",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="38", description="Название аудитории")
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Аудитория добавлена",
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
    public function createAudience(AudienceFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        Audience::create([
            'name' => $request['name']
        ]);

        return $this->sendResp('Успешно', 'Аудитория была успешно добавлена', 200);
    }

    /**
     * @param AudienceFormRequest $req
     * @return JsonResponse
     * @OA\Delete(
     *     path="/api/Audience",
     *     description="Удалить аудиторию",
     *     tags={"Audience"},
     *     @OA\RequestBody(
     *          description="Тело запроса для удаления аудитории",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1", description="ID аудитории")
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Аудитория удалена",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessRespone")
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Валидация не пройдена",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse",)
     *     )
     * )
     */
    public function deleteAudience(AudienceFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $audience = Audience::find($request['id']);
        $audience->delete();

        return $this->sendResp('Успешно', 'Аудитория была успешно удалена', 200);
    }

    /**
     * @param AudienceFormRequest $req
     * @return JsonResponse
     * @OA\Patch(
     *     path="/api/Audience",
     *     description="Отредактировать аудиторию",
     *     tags={"Audience"},
     *     @OA\RequestBody(
     *          description="Тело запроса для редактирования аудитории",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"id", "name"},
     *              @OA\Property(property="id", type="integer", example="1", description="ID аудитории"),
     *              @OA\Property(property="name", type="string", example="38", description="Название аудитории")
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Аудитория отредактирована",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessRespone")
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Валидация не пройдена",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse",)
     *     )
     * )
     */
    public function editAudience (AudienceFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $audience = Audience::find($request['id']);
        $audience->name = $request['name'];
        $audience->save();

        return $this->sendResp('Успешно', 'Аудитория была успешно отредактирована', 200);
    }
}
