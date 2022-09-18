<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TimeConvert
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();
        if (isset($input['start_time']) && isset($input['end_time'])) {
            $start_time = explode(':', $input['start_time']);
            $end_time = explode(':', $input['end_time']);

            $input['start_time'] = [
                'hours' => $start_time[0],
                'minutes' => $start_time[1]
            ];
            $input['end_time'] = [
                'hours' => $end_time[0],
                'minutes' => $end_time[1]
            ];

            $request->replace($input);
        }


        return $next($request);
    }
}
