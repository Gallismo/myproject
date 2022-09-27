<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class WeekRequest extends AdminRequest
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
