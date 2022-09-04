<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Group;
use App\Rules\EntityExist;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupsBookingsRequest extends FormRequest
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['title' => 'Ошибка валидации',
            'text' => 'Проверьте правильность заполнения полей',
            'errors' => $validator->errors()], 422));
    }
}
