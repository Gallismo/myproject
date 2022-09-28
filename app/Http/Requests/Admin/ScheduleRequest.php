<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class ScheduleRequest extends AdminRequest
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
                    'week_day_id' => 'required|integer|exists:week_days,id',
                    'lesson_order_id' => 'required|integer|exists:lessons_orders,id',
                    'department_id' => 'required|integer|exists:departments,id',
                    'start_time' => 'required|array:hours,minutes',
                    'start_time.hours' => "required|min:2|max:2|string",
                    'start_time.minutes' => "required|min:2|max:2|string",
                    'end_time' => 'required|array:hours,minutes',
                    'end_time.hours' => "required|min:2|max:2|string",
                    'end_time.minutes' => "required|min:2|max:2|string",
                    'break' => 'integer'
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => 'required|integer|exists:schedules,id'
                ];
            } break;

            case 'PATCH': {
                return [
                    'id' => 'required|integer|exists:schedules,id',

                    'week_day_id' => 'exclude',
                    'lesson_order_id' => 'exclude',
                    'department_id' => 'exclude',

                    'start_time' => 'required_without_all:week_day_id,lesson_order_id,department_id,end_time,break|
                    required_with:end_time|array:hours,minutes',

                    'start_time.hours' => "required_with_all:end_time,start_time|min:2|max:2|string",
                    'start_time.minutes' => "required_with_all:end_time,start_time|min:2|max:2|string",

                    'end_time' => 'required_without_all:week_day_id,lesson_order_id,department_id,start_time,break|
                    required_with:start_time|array:hours,minutes',

                    'end_time.hours' => "required_with_all:end_time,start_time|min:2|max:2|string",
                    'end_time.minutes' => "required_with_all:end_time,start_time|min:2|max:2|string",

                    'break' => 'integer|required_without_all:week_day_id,lesson_order_id,start_time,end_time,department_id'
                ];
            } break;

            default: {
                return [];
            } break;
        }
    }
}
