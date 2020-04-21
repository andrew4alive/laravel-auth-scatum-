<?php

namespace App\Http\Middleware;

use Closure;

class OnlyOneUser
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

        $user_count = \App\User::count();
        if($user_count>0){
            return \redirect("login");
        }
        return $next($request);
    }
}
