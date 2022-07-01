<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Rules\EntityExist;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DepartmentFormRequest extends FormRequest
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
                    'name' => ['required', 'string', 'unique:departments'],
                ];
            } break;

            case 'DELETE': {
                return [
                    'code' => ['required', 'string', new EntityExist(Department::class)],
                ];
            } break;

            case 'PATCH': {
                return [
                    'name' => ['required', 'string', 'unique:departments'],
                    'code' => ['required', 'string', new EntityExist(Department::class)],
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
