<?php

namespace App\Http\Requests\Admin\GetRequests;

use App\Http\Requests\AdminRequest;

class GetBookingGroupRequest extends AdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => ['required', 'date_format:Y-m-d'],
            'lesson_order_id' => ['required', 'exists:lessons_orders,id', 'integer'],
            'group_id' => ['required', 'exists:groups,id', 'integer']
        ];
    }
}
