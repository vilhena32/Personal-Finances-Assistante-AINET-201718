<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Account;


class AccountExists
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
        $account = Account::findOrFail($request->account);

        if ($account === null) {
            return response("Account doesn't exist!", 404);
        }
        
        return $next($request);
    } 
}