<?php

namespace App\Http\Middleware;

use App\Channel;
use Closure;
use Illuminate\Database\Eloquent\Model;

class TypeMiddleware
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
        $channel = Channel::where('slug', $request->segments()[2])->first();
        //only admin
        if ($channel->type == 1)          {
            if (\Auth::id() == \Config::get('main.admin_id')) {

                return $next($request);
            }
        }
        elseif ($channel->type == 0)
        {
            return $next($request);
        }

        return redirect()->back();

    }
}
