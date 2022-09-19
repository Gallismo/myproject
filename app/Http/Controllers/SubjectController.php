<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectFormRequest;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function deleteSubject (Request $request) {
        $val = Validator::make($request->all(), [
            'code' => 'required|string'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $subject = Subject::where('code', '=', $request->code)->first();

        if(is_null($subject)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого предмета не существует',
                'errors' => $val->errors()], 422);
        }

        $subject->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Предмет был успешно удалён',
            'errors' => $val->errors()], 200);
    }
}
