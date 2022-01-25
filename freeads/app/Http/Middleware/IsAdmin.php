<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        //if not admin
        if(auth()->user()->admin == 'no'){
            abort(403);
        }else{
        //if admin ok
        return $next($request);
        }
    }
}
