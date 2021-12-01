<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BearerToken
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
                return $next($request);
            }
        }

        if (!auth()->check()) {
            return response()->json('Unauthorized', 401);
        }

    }
}
