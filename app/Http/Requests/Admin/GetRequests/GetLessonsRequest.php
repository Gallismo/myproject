<?php

namespace App\Http\Requests\Admin\GetRequests;

use App\Http\Requests\AdminRequest;
use App\Rules\isTeacher;

class GetLessonsRequest extends AdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_filter' => ['sometimes', 'date_format:Y-m-d'],
            'les_filter' => ['sometimes', 'exists:lessons_orders,id', 'integer'],
            'teacher_filter' => ['sometimes', 'exists:users,id', 'integer', new isTeacher()],
            'aud_filter' => ['sometimes', 'exists:audiences,id', 'integer'],
            'dep_filter' => ['sometimes', 'exists:departments,id', 'integer'],
        ];
    }
}
