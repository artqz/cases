<?php

namespace App\Http\Middleware;

use Closure;

class UserIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::id() == \Config::get('main.admin_id')) {
            return $next($request);
        }
        return redirect()->back();
    }
}
