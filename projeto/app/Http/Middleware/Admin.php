<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


class Admin
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
      //  dd($request);
        if (Auth::check()){
            if(Auth::user()->admin ==1)
            {
                return $next($request);                
            }
            return redirect('/');
        }        
    } 
}