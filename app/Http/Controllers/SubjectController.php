<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\SubjectFormRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function createSubject (SubjectFormRequest $request) {
        $request = $request->validated();

        Subject::create([
            'name' => $request['name']
        ]);

        return $this->sendResp('Успешно', 'Предмет был успешно добавлен', 200);
    }

    public function editSubject (SubjectFormRequest $request) {
        $request = $request->validated();


        $subject = Subject::find($request['id']);
        $subject->name = $request['name'];
        $subject->save();

        return $this->sendResp('Успешно', 'Предмет был успешно отредактирован', 200);
    }

    public function deleteSubject (SubjectFormRequest $request) {
        $request = $request->all();

        Subject::find($request['id'])->delete();

        return $this->sendResp('Успешно', 'Предмет был успешно удалён', 200);
    }
}
