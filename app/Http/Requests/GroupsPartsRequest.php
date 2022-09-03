<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
