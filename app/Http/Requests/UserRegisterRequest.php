<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRegisterRequest extends MyRequest
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
        return [
            'name' => 'required|string|min:3',
            'login' => 'required|string|min:6|unique:users',
            'password' => ['required','string', Password::min(6)->letters()->numbers()],
            'role_id' => 'required|integer|exists:roles,id',
            'group_id' => 'required_if:role_id,==,3|exists:groups,id|integer'
        ];
    }
}
