<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        }

//        return response()->json(['title' => 'Ошибка аутентификации',
//            'text' => 'Для доступа необходим вход',
//            'errors' => new \stdClass(c)], 401);

        return abort(401);
    }
}
