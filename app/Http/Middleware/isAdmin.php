<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
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
        $token = Str::replaceFirst('Bearer ', '', $request->header('authorization'));
        foreach (User::all() as $user) {
            if (Hash::check($token, $user->jwt_token)) {
                if ($user->is_admin==true) {
                    return $next($request);
                }
            }
        }
//        if (!auth()->user()->is_admin) {
//            return response()->json('You do not have admin permission', 401);
//        }
        return response()->json('You do not have admin permission', 401);
    }
}
