<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;

interface ErrorResponseContract
{
    public function __invoke(string $title, string $text, Validator $val, int $resCode): JsonResponse;
}
