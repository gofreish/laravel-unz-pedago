<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class programme
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
        if ( in_array('coordonateur', $roles) || in_array('admin', $roles) || in_array('scolarite', $roles) ) {
            return $next($request);
        }
        else{
            return abort( 403, "Vous n'êtes pas AUTORISÉ à accéder à cette page" );
            
        }

        return $next($request);
    }
}
