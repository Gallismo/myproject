<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;
use App\Rules\isTeacher;

class LessonsBookingsRequest extends AdminRequest
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
                    'lesson_date' => 'required|date-format:Y-m-d',
                    'lesson_order_id' => 'required|exists:lessons_orders,id|integer',
                    'audience_id' => 'required|exists:audiences,id|integer',
                    'subject_id' => 'required|exists:subjects,id|integer',
                    'teacher_id' => ['required', 'exists:users,id', 'integer', new isTeacher()],
                    'is_remote' => 'boolean',
                    'conference_url' => 'string|url',
                    'lesson_topic' => 'string',
                    'lesson_homework' => 'string'
                ];
            } break;

            case 'DELETE': {
                return [
                    'id' => 'required|exists:lessons_bookings,id|integer'
                ];
            } break;

            case 'PATCH': {
                return [
                    'id' => 'required|exists:lessons_bookings,id|integer',

                    'lesson_date' => 'required_without_all:lesson_order_id,audience_id,subject_id,
                    teacher_id,is_remote,conference_url,lesson_topic,lesson_homework|date-format:Y-m-d',

                    'lesson_order_id' => 'required_without_all:lesson_date,audience_id,subject_id,
                    teacher_id,is_remote,conference_url,lesson_topic,lesson_homework|exists:lessons_orders,id|integer',

                    'audience_id' => 'required_without_all:lesson_date,lesson_order_id,subject_id,
                    teacher_id,is_remote,conference_url,lesson_topic,lesson_homework|exists:audiences,id|integer',

                    'subject_id' => 'required_without_all:lesson_date,audience_id,lesson_order_id,
                    teacher_id,is_remote,conference_url,lesson_topic,lesson_homework|exists:subjects,id|integer',

                    'teacher_id' => ['required_without_all:lesson_date,audience_id,subject_id,
                    lesson_order_id,is_remote,conference_url,lesson_topic,lesson_homework',
                        'exists:users,id', 'integer', new isTeacher()],

                    'is_remote' => 'boolean|required_without_all:lesson_date,audience_id,subject_id,
                    teacher_id,lesson_order_id,conference_url,lesson_topic,lesson_homework',

                    'conference_url' => 'string|url|required_without_all:lesson_date,audience_id,subject_id,
                    teacher_id,is_remote,lesson_order_id,lesson_topic,lesson_homework',

                    'lesson_topic' => 'string|required_without_all:lesson_date,audience_id,subject_id,
                    teacher_id,is_remote,conference_url,lesson_order_id,lesson_homework',

                    'lesson_homework' => 'string|required_without_all:lesson_date,audience_id,subject_id,
                    teacher_id,is_remote,conference_url,lesson_topic,lesson_order_id'
                ];
            } break;

            default: {
                return [];
            } break;
        }
    }
}
