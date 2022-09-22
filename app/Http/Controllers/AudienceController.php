<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudienceFormRequest;
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
     *     tags={"Audience"},
     *     @OA\RequestBody(
     *          description="Название для созданной аудитории",
     *          required=true,
     *          @OA\JsonContent(
     *              example={
     *                  "name": "38"
     *              }
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Аудитория добавлена",
     *     ),
     *     @OA\Response(
     *          response="422",
     *          description="Валидация не пройдена",
     *          @OA\JsonContent(
     *              example={"title": "Ошибка валидации","text": "Проверьте правильность заполнения полей","errors": {"name": {"Поле `Название` обязательно для заполнения."}}}
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
