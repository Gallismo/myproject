<?php

namespace App\Http\Requests;

use App\Models\Audience;
use App\Rules\EntityExist;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AudienceFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {

            case 'POST': {
                return [
                    'name' => ['required', 'string', 'max:18', 'min:2', 'unique:audiences'],
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => ['required', 'integer', 'exists:audiences,id'],
                ];
            } break;

            case 'PATCH': {
                return [
                    'name' => ['required', 'string', 'max:18', 'min:2', 'unique:audiences'],
                    'id' => ['required', 'integer', 'exists:audiences,id'],
                ];
            } break;

            default: {
                return [];
            } break;
        }

    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['title' => 'Ошибка валидации',
            'text' => 'Проверьте правильность заполнения полей',
            'errors' => $validator->errors()], 422));
    }
}
