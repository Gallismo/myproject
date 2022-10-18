<?php

namespace App\Actions;

use App\Contracts\ErrorResponseContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;

class ErrorResponseAction implements ErrorResponseContract
{

    public function __invoke(string $title, string $text, $errors, int $resCode): JsonResponse
    {
        return response()->json(['title' => $title,
            'body' => $text,
            'errors' => $errors], $resCode);
    }
}
