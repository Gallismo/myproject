<?php

namespace App\Http\Controllers;


use App\Contracts\ErrorResponseContract;
use App\Contracts\ResponseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Расписание УГКТиД",
 *      description="Документация для REST API сервиса Онлайн-расписание ГБПОУ УГКТиД",
 * ),
 * @OA\Tag(
 *     name="Audience",
 *     description="Аудитории"
 * ),
 * @OA\Tag(
 *     name="Department",
 *     description="Отделения"
 * ),
 * @OA\Tag(
 *     name="Group",
 *     description="Группы"
 * ),
 * @OA\Schema(
 *     schema="ErrorResponse",
 *     @OA\Property(
 *          property="title",
 *          type="string",
 *          description="Заголовок ошибки"
 *     ),
 *     @OA\Property(
 *          property="text",
 *          type="string",
 *          description="Текст ошибки"
 *     ),
 *     @OA\Property(
 *          property="errors",
 *          type="object",
 *          description="Список с названиями полей и найденными ошибками",
 *          @OA\AdditionalProperties(type="array", description="Массив ошибок по конкретному полю",
 *              @OA\Items(type="string", description="Найденная ошибка")
 *          )
 *     )
 * ),
 * @OA\Schema(
 *     schema="SuccessRespone",
 *     @OA\Property(
 *          property="title",
 *          type="string",
 *          description="Заголовок ответа"
 *     ),
 *     @OA\Property(
 *          property="text",
 *          type="string",
 *          description="Текст ответа"
 *     ),
 *     @OA\Property(
 *          property="errors",
 *          type="object",
 *          description="Список с названиями полей и найденными ошибками",
 *
 *     )
 * ),
 */
class Controller extends BaseController
{
    protected ResponseContract $sendResp;
    protected ErrorResponseContract $sendError;

    public function __construct(ResponseContract $responseContract, ErrorResponseContract $errorResponseContract)
    {
        $this->sendResp = $responseContract;
        $this->sendError = $errorResponseContract;
    }

    protected function sendResp(string $title, string $text, int $code): JsonResponse
    {
        $sendResp = $this->sendResp;
        return $sendResp($title, $text, $code);
    }

    protected function sendError(string $title, string $text, $errors, int $code): JsonResponse
    {
        $sendResp = $this->sendError;
        return $sendResp($title, $text, $errors, $code);
    }

    protected function deleteSomething(Model $model, int|string $id, JsonResponse $successResp) {
        try {
            $model->find($id)->delete();
            return $successResp;
        } catch (QueryException $exception) {
            if ($exception->getCode() == 23000) {
                return $this->sendResp('Ошибка', 'Удаление данной записи невозможно, от нее зависят другие дочерние данные!', 422);
            }
            return $this->sendResp('Ошибка', 'Произошла непредвиденная ошибка, обратитесь к администратору', 422);
        }
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
