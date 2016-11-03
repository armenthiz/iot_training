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
        $access = $request->route()->getName();
        $user = Sentinel::getUser();
        // $id = $user['original']['id'];
        // $userId = Sentinel::findById($id);

        if ($user->hasAccess($access)) {
            return $next($request);
        } elseif ($user->hasAccess(['admin'])) {
            return $next($request);
        } else {
            Session::flash('error', 'You dont have privilege');
            return redirect()->route('root');
        }
    }
}
