<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupsPartsRequest extends FormRequest
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
                    'name' => 'required|string|unique:groups_parts'
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => 'required|integer|exists:groups_parts,id'
                ];
            } break;

            case 'PATCH': {
                return [
                    'id' => 'required|integer|exists:groups_parts,id',
                    'name' => 'required|string|unique:groups_parts'
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