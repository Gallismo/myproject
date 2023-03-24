<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

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
        Cookie::queue(Cookie::forget('isAdmin'));
        return abort(401);
    }
}
