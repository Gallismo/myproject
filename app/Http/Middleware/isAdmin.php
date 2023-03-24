<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role_id == 1) {
            return $next($request);
        }
//        if (!auth()->user()->is_admin) {
//            return response()->json('You do not have admin permission', 401);
//        }

//        return response()->json(['title' => 'Ошибка авторизации',
//            'text' => 'Вы не имеета доступа',
//            'errors' => new \stdClass()], 401);
        Cookie::queue(Cookie::forget('isAdmin'));
        return abort(401);
    }
}
