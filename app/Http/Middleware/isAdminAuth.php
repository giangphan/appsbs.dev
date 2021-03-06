<?php

namespace App\Http\Middleware;

use Closure;

class isAdminAuth
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
        if($request->user()->role != 'Admin'){
            return back();
        }
        return $next($request);
    }
}
