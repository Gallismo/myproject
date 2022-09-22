<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WeekRequest extends MyRequest
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
                    'name' => 'required|string|unique:week_days'
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => 'required|integer|exists:week_days,id'
                ];
            } break;

            case 'PATCH': {
                return [
                    'name' => 'required|string|unique:week_days',
                    'id' => 'required|integer|exists:week_days,id'
                ];
            } break;

            default: {
                return [];
            } break;
        }
    }
}
