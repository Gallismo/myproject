<?php

namespace App\Http\Requests;

use App\Rules\isTeacher;
use Illuminate\Foundation\Http\FormRequest;

class LessonsRequest extends MyRequest
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
        return [
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'group_id' => ['sometimes', 'exists:groups,id', 'integer'],
            'teacher_id' => ['sometimes', 'exists:users,id', 'integer', new isTeacher()],
            'audience_id' => ['sometimes', 'exists:audiences,id', 'integer'],
        ];
    }
}
