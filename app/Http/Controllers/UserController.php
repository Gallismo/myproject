<?php

namespace App\Http\Controllers;

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
            'name' => 'required|string',
            'login' => 'required|string|min:6|unique:users',
            'teacher_id' => 'integer|unique:users',
            'password' => 'required|string|min:6',
            'registerValue' => 'required|string',
            'secretValue' => 'string'
        ]);
        $is_admin = false;

        if ($val->fails()) {
            return response()->json(['error' => ['code' => '422', 'message' => 'Validation error', 'errors' => $val->errors()]], 422);
        }

        if (!Hash::check('kutakBash', $request->registerValue)) {
            return response()->json("Register code is incorrect, access denied", 422);
        }
        if (Hash::check('lox', $request->secretValue)) {
//            return response()->json("Secret code is incorrect, access denied", 422);
            $is_admin = true;
        }
        $jwt_token = Str::random(30);
        User::create([
            'name' => $request->name,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'teacher_id' => $request->teacher_id,
            'jwt_token' => Hash::make($jwt_token),
            'is_admin' => $is_admin
        ]);

        return response()->json("User created, token: ".$jwt_token, 201);
    }

    public function login(Request $request) {
        $val = Validator::make($request->all(), [
           'login' => 'required',
           'password' => 'required'
        ]);

        if ($val->fails()) {
            return response()->json(['error' => ['code' => '422', 'message' => 'Validation error', 'errors' => $val->errors()]], 422);
        }

        $user = User::where('login', $request->login)->first();

        if (is_null($user) || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => ['code' => '401', 'message' => 'Unauthorized', 'errors'  => 'phone or password incorrect']], 401);
        }

        $token = Str::random(30);
        $user->jwt_token = Hash::make($token);
        $user->save();

        return response()->json(['data' => ['token' => $token]], 200);
    }

    public function changePassword (Request $request) {
        $val = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        if ($val->fails()) {
            return response()->json(['error' => ['code' => '422', 'message' => 'Validation error', 'errors' => $val->errors()]], 422);
        }

        $user = User::where('login', $request->login)->first();

        if (is_null($user)) {
            return response()->json(['error' => ['code' => '422', 'message' => 'User doesnt exist']], 422);
        }

        $user->password = Hash::make($request->password);
        $user->jwt_token = null;

        $user->save();

        return response()->json(['response' => 'Password changed'], 200);
    }

    public function deleteUser (Request $request) {
        $user = User::where('login', $request->login);

        if (is_null($user)) {
            return response()->json(['response' => 'User doesnt exist'], 422);
        }

        $user->delete();

        return response()->json(['response' => 'User has been deleted'], 200);
    }
}
