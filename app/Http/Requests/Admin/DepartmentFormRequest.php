<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class DepartmentFormRequest extends AdminRequest
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
                    'name' => ['required', 'integer', 'unique:departments'],
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => ['required', 'integer', 'exists:departments,id'],
                ];
            } break;

            case 'PATCH': {
                return [
                    'name' => ['required', 'string', 'unique:departments'],
                    'id' => ['required', 'integer', 'exists:departments,id'],
                ];
            } break;

            default: {
                return [];
            } break;
        }

    }
}
