<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AudienceController extends Controller
{
    public function createAudience(Request $request) {
        $val = Validator::make($request->all(), [
           'name' => 'required|string|max:2|min:2|unique:audiences'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $val = Validator::make($request->all(), [
            'name' => 'integer'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $code = $this->codeGenerate(Audience::class);
        Audience::create([
            'name' => $request->name,
            'code' => $code
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Аудитория была успешно добавлена',
            'errors' => $val->errors()], 200);
    }

    public function deleteAudience(Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $audience = Audience::where('code', '=', $request->code)->first();

        if (is_null($audience)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такой аудитории не существует',
                'errors' => $val->errors()], 422);
        }

        $audience->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Аудитория была успешно удалена',
            'errors' => $val->errors()], 200);
    }

    public function editAudience (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $audience = Audience::where('code', '=', $request->code)->first();

        if (is_null($audience)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Аудитория не существует',
                'errors' => $val->errors()], 422);
        }

        $audience->name = $request->name;
        $audience->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Аудитория была успешно отредактирована',
            'errors' => $val->errors()], 200);
    }
}
