<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Testing\Fluent\Concerns\Has;
use phpDocumentor\Reflection\Types\Boolean;

class UserController extends Controller
{
    public function register(Request $request) {
        $val = Validator::make($request->all(), [
            'login' => 'required|string|min:6|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'integer|exists:roles,id|required'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $jwt_token = Str::random(30);
        User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'jwt_token' => Hash::make($jwt_token),
        ]);

        return response()->json(['title' => 'Успешно',
            'text' => 'Пользователь был успешно создан',
            'errors' => $val->errors()], 200);
    }

    public function login(Request $request) {
        $val = Validator::make($request->all(), [
           'login' => 'required',
           'password' => 'required'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $user = User::where('login', $request->login)->first();

        if (is_null($user) || !Hash::check($request->password, $user->password)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Проверьте правильность заполения, логин или пароль неверны',
                'errors' => $val->errors()], 422);
        }

        $token = Str::random(30);
        $user->jwt_token = Hash::make($token);
        $user->save();

        return response()->json(['data' => ['token' => $token, 'role' => $user->role_id]], 200);
    }

    public function changePassword (Request $request) {
        $val = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        if ($val->fails()) {
            return response()->json(['title' => 'Ошибка валидации',
                'text' => 'Проверьте правильность заполнения полей',
                'errors' => $val->errors()], 422);
        }

        $user = User::where('login', $request->login)->first();

        if (is_null($user)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого пользователя не существует',
                'errors' => $val->errors()], 422);
        }

        $user->password = Hash::make($request->password);
        $user->jwt_token = null;

        $user->save();

        return response()->json(['title' => 'Успешно',
            'text' => 'Пароль был изменён',
            'errors' => $val->errors()], 200);
    }

    public function deleteUser (Request $request) {
        $user = User::where('login', $request->login);

        if (is_null($user)) {
            return response()->json(['title' => 'Ошибка',
                'text' => 'Такого пользователя не существует',
                'errors' => new \stdClass()], 422);
        }

        $user->delete();

        return response()->json(['title' => 'Успешно',
            'text' => 'Пользователь удалён',
            'errors' => new \stdClass()], 200);
    }
}
