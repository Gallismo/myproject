<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;

interface ResponseContract
{
    public function __invoke(string $title, string|array $body, int $resCode): JsonResponse;
}