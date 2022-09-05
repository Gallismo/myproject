<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ScheduleRequest extends FormRequest
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
                    'id' => 'required|exists:lessons_bookings,id'
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

                    'teacher_id' => 'required_without_all:lesson_date,audience_id,subject_id,
                    lesson_order_id,is_remote,conference_url,lesson_topic,lesson_homework|exists:users,id|integer',

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


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['title' => 'Ошибка валидации',
            'text' => 'Проверьте правильность заполнения полей',
            'errors' => $validator->errors()], 422));
    }
}
