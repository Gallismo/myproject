<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UserRegisterRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\UserChPassRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $request = $request->validated();

        if ($request['role_id'] != 3 && !empty($request['group_id'])) {
            return $this->sendResp('Ошибка', 'Привязка группы возможна только к пользователям с ролью "Староста"', 422);
        }

        User::create([
            'name' => $request['name'],
            'login' => $request['login'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['role_id'],
            'group_id' => $request['group_id'] ?? null
        ]);

        return $this->sendResp('Успешно', 'Пользователь был успешно создан', 200);
    }

    public function login(Request $request)
    {
        $request = $request->all();
        $val = Validator::make($request, [
            'login' => 'required|exists:users,login',
            'password' => 'required'
        ]);

        if ($val->fails()) {
            return back()->with('errorTitle', 'Ошибка')->with('errorText', 'Неверный логин или пароль');
//            return $this->sendError('sdfdsfs', 'sdgsdgsd', $val->errors(), 422);
        }

        $user = User::where('login', $request['login'])->first();

        if (!Hash::check($request['password'], $user->password)) {
            return back()->with('errorTitle', 'Ошибка')->with('errorText', 'Неверный логин или пароль');
//            return $this->sendResp('Ошибка', 'Проверьте правильность заполения, пароль неверный', 422);
        }

        Auth::login($user);

        if ($user->role_id == 1) {
            return redirect('/admin');
        }

        return redirect('/');
    }

    public function logout () {
        Auth::logout();

        return redirect('/');
    }

    public function changePassword (UserChPassRequest $request): JsonResponse
    {
        $request = $request->validated();

        $user = User::where('login', $request['login'])->first();
        $user->password = Hash::make($request['password']);
        $user->save();

        return $this->sendResp('Успешно', 'Пароль был изменён', 200);
    }

    public function deleteUser (UserRequest $request) {
        $request = $request->validated();

        User::where('login', $request['login'])->first()->delete();

        return $this->sendResp('Успешно', 'Пользователь удалён', 200);
    }

    public function editUser (UserRequest $request): JsonResponse
    {
        $request = $request->validated();

        $user = User::where('login', $request['login'])->first();

        $user->name = $request['name'] ?? $user->name;
        $user->role_id = $request['role_id'] ?? $user->role_id;
        $user->group_id = $request['group_id'] ?? $user->group_id;

        if ($user->role_id != 3) {
            $user->group_id = null;
        }

        $user->save();

        return $this->sendResp('Успешно', 'Пользователь был успешно отредактирован', 200);
    }
}
