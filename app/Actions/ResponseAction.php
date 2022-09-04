<?php

namespace App\Actions;

use Illuminate\Http\JsonResponse;

class ResponseAction implements \App\Contracts\ResponseContract
{

    public function __invoke(string $title, string|array $body, int $resCode): JsonResponse
    {
        return response()->json(['title' => $title,
            'body' => $body,
            'errors' => new \stdClass()], $resCode);
    }
}
