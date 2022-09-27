<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class AudienceFormRequest extends AdminRequest
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
}
