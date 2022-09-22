<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends MyRequest
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

            case 'DELETE': {
                return [
                    'login' => 'required|string|exists:users,login',
                ];
            } break;

            case 'PATCH': {
                return [
                    'login' => 'required|string|min:6|exists:users,login',
                    'role_id' => 'integer|exists:roles,id|required_without_all:name,group_id',
                    'name' => 'required_without_all:role_id,group_id|string|min:3',
                    'group_id' => 'required_if:role_id,3|exclude_if:role_id,1,2|exists:groups,id|integer'
                ];
            } break;

            default: {
                return [];
            } break;
        }
    }
}
