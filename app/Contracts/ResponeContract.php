<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;

interface ResponeContract
{
    public function __invoke(string $title, string $text, int $resCode): JsonResponse;
}
