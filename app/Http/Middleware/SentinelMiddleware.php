<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Session;

class SentinelMiddleware
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
        if (Sentinel::guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                Session::flash("warning","You need to login first in order to access the page");
                return redirect()->guest('login');
            }
        }
        return $next($request);
    }
}
