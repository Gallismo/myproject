<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Group;
use App\Rules\EntityExist;
use App\Rules\StringAndInteger;
use App\Rules\Year;
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
                    'department_id' => ['required','integer', 'exists:departments,id'],
                    'start_year' => ['required', 'integer', new Year()],
                    'end_year' => ['required', 'integer', new Year()]
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => ['required', 'integer', 'exists:groups,id'],
                ];
            } break;

            case 'PATCH': {
                return [
                    'id' => ['required', 'integer', 'exists:groups,id'],
                    'name' => ['required_without_all:start_year,end_year,department_code',
                        'string', 'unique:groups,name', 'max:14'],
                    'department_id' => ['required_without_all:start_year,end_year,name',
                        'string', 'exists:departments,id'],
                    'start_year' => ['required_without_all:department_code,end_year,name', 'integer', new Year()],
                    'end_year' => ['required_without_all:department_code,start_year,name', 'integer', new Year()]
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
