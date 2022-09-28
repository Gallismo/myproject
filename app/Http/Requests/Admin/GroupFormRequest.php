<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;
use App\Rules\StringAndInteger;
use App\Rules\Year;

class GroupFormRequest extends AdminRequest
{

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
}
