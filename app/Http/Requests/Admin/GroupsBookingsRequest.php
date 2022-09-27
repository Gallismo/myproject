<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class GroupsBookingsRequest extends AdminRequest
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
                    'booking_id' => 'required|integer|exists:lessons_bookings,id',
                    'group_id' => 'required|integer|exists:groups,id',
                    'group_part_id' => 'required|integer|exists:groups_parts,id'
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => 'required|integer|exists:groups_bookings,id'
                ];
            } break;

            case 'PATCH': {
                return [
                    'id' => 'required|integer|exists:groups_bookings,id',
                    'booking_id' => 'required_without_all:group_part_id|integer|exists:lessons_bookings,id',
                    'group_id' => 'required_without_all:group_part_id|integer|exists:groups,id',
                    'group_part_id' => 'required_without_all:booking_id,group_id|integer|exists:groups_parts,id'
                ];
            } break;

            default: {
                return [];
            } break;
        }
    }
}
