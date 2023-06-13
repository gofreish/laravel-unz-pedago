<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class csaf
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
        $roles = explode(',', $request->user()->menuroles);
        if ( in_array('csaf', $roles) || in_array('admin', $roles) ) {
            return $next($request);
        }
        else{
            return abort( 403, "Vous n'êtes pas AUTORISÉ à accéder à cette page" );
        }

    }
}
