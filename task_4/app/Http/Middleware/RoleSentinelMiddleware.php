<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Session;

class RoleSentinelMiddleware
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
        // Begin to get the current accessed route name
        $access = $request->route()->getName();

        // Begin checking
        if (Sentinel::hasAccess($access)) {
            return $next($request);
        } elseif (Sentinel::hasAccess(['admin'])) {
            return $next($request);
        } else {
            Session::flash('error', 'You dont have privilege');
            return redirect()->route('root');
        }
    }
}
