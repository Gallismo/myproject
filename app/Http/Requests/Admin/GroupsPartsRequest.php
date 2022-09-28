<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class GroupsPartsRequest extends AdminRequest
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
}
