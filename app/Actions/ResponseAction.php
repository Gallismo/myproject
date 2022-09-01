<?php

namespace App\Actions;

use Illuminate\Http\JsonResponse;

class ResponseAction implements \App\Contracts\ResponeContract
{

    public function __invoke(string $title, string $text, int $resCode): JsonResponse
    {
        return response()->json(['title' => $title,
            'text' => $text,
            'errors' => new \stdClass()], $resCode);
    }
}
