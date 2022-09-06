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

class Controller extends BaseController
{
    protected $sendResp;
    protected $sendError;

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

    protected function codeGenerate ($model) {
        $symbols = "QWERTYUIOPASDFGHJKLZXCVBNM123456789qwertyuiopasdfghjklzxcvbnm";
        $code = "";

        for ($i=0;$i<30;$i++) {
            if ($i % 10 == 0 && $i>1) {
                $code .= '-';
            }
            $code .= substr($symbols, rand(1, 61) - 1, 1);
        }

        $record = $model::where('code', $code)->first();

        if ($record || !$code) {
            $code = $this->codeGenerate($model);
        }

        return $code;
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
