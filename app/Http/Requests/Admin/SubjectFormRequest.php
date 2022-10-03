<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class SubjectFormRequest extends AdminRequest
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
                    'name' => 'required|string|unique:subjects'
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => 'required|integer|exists:subjects,id'
                ];
            } break;

            case 'PATCH': {
                return [
                    'name' => 'required|string|unique:subjects',
                    'id' => 'required|integer|exists:subjects,id'
                ];
            } break;

            default: {
                return [];
            } break;
        }
    }
}
