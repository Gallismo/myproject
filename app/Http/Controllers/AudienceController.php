<?php

namespace App\Http\Controllers;

use App\Contracts\FindByCodeContract;
use App\Contracts\ResponeContract;
use App\Http\Requests\AudienceFormRequest;
use App\Models\Audience;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudienceController extends Controller
{
    public function createAudience(AudienceFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        Audience::create([
            'name' => $request['name']
        ]);

        return $this->sendResp('Успешно', 'Аудитория была успешно добавлена', 200);
    }

    public function deleteAudience(AudienceFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $audience = Audience::find($request['id']);
        $audience->delete();

        return $this->sendResp('Успешно', 'Аудитория была успешно удалена', 200);
    }

    public function editAudience (AudienceFormRequest $req): JsonResponse
    {
        $request = $req->validated();

        $audience = Audience::find($request['id']);
        $audience->name = $request['name'];
        $audience->save();

        return $this->sendResp('Успешно', 'Аудитория была успешно отредактирована', 200);
    }
}
