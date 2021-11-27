<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request) {
        $val = Validator::make($request->all(), [
            'name' => 'required|string',
            'login' => 'required|string|min:6|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if ($val->fails()) {
            return response()->json(['error' => ['code' => '422', 'message' => 'Validation error', 'errors' => $val->errors()]], 422);
        }

        return response()->json($request->name, 200);
    }
}
