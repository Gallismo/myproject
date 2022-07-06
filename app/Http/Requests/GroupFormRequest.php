<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Group;
use App\Rules\EntityExist;
use App\Rules\StringAndInteger;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupFormRequest extends FormRequest
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
                    'name' => ['required','unique:groups','string','max:14'],
                    'department_code' => ['required','string', new EntityExist(Department::class)],
                    'start_year' => ['required', 'min:4', 'max:4','string'],
                    'end_year' => ['required', 'min:4', 'max:4','string']
                ];
            } break;

            case 'DELETE': {
                return [
                    'code' => ['required', 'string', new EntityExist(Group::class)],
                ];
            } break;

            case 'PATCH': {
                return [
                    'code' => ['required', 'string'],
                    'name' => ['required_without_all:start_year,end_year,department_code',
                        'string', 'unique:groups,name', 'max:14'],
                    'department_code' => ['required_without_all:start_year,end_year,name',
                        'string', new EntityExist(Department::class)],
                    'start_year' => ['required_without_all:department_code,end_year,name', 'string', 'min:4', 'max:4'],
                    'end_year' => ['required_without_all:department_code,start_year,name', 'string', 'min:4', 'max:4']
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
