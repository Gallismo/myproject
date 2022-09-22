<?php

namespace App\Http\Controllers;


use App\Contracts\ErrorResponseContract;
use App\Contracts\ResponseContract;
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
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
