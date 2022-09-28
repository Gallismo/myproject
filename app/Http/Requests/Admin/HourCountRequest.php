<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class HourCountRequest extends AdminRequest
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
                    'group_id' => 'required|integer|exists:groups,id',
                    'subject_id' => 'required|integer|exists:subjects,id',
                    'hours' => 'required|integer|min:1'
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => 'required|integer|exists:subject_hour_counts,id'
                ];
            } break;

            case 'PATCH': {
                return [
                    'id' => 'required|integer|exists:subject_hour_counts,id',
                    'group_id' => 'required_without_all:subject_id,hours|integer|exists:groups,id',
                    'subject_id' => 'required_without_all:group_id,hours|integer|exists:subjects,id',
                    'hours' => 'required_without_all:group_id,subject_id|integer|min:1',
                ];
            } break;

            default: {
                return [];
            } break;
        }
    }
}
