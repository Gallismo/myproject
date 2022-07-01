<?php

namespace App\Http\Controllers;

use App\Http\Requests\AudienceFormRequest;
use App\Models\Audience;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudienceController extends Controller
{
    public function createAudience(AudienceFormRequest $req) {
        $request = $req->validated();

        $code = $this->codeGenerate(Audience::class);
        Audience::create([
            'name' => $request['name'],
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Аудитория была успешно добавлена',
            'errors' => new \stdClass()], 200);
    }

    public function deleteAudience(AudienceFormRequest $req) {
        $request = $req->validated();

        $audience = Audience::where('code', '=', $request['code'])->first();
        $audience->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Аудитория была успешно удалена',
            'errors' => new \stdClass()], 200);
    }

    public function editAudience (AudienceFormRequest $req) {
        $request = $req->validated();

        $audience = Audience::where('code', '=', $request['code'])->first();
        $audience->name = $request['name'];
        $audience->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Аудитория была успешно отредактирована',
            'errors' => new \stdClass()], 200);
    }
}
