<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class LessonsOrdersRequest extends AdminRequest
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
                    'name' => 'required|string|unique:lessons_orders'
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => 'required|exists:lessons_orders,id|integer'
                ];
            } break;

            case 'PATCH': {
                return [
                    'name' => 'required|string|unique:lessons_orders',
                    'id' => 'required|integer|exists:lessons_orders,id'
                ];
            } break;

            default: {
                return [];
            } break;
        }
    }
}
