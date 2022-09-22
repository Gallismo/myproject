<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MyRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['title' => 'Ошибка валидации',
            'text' => 'Проверьте правильность заполнения полей',
            'errors' => $validator->errors()], 422));
    }
}
