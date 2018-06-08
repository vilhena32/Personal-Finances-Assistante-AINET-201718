<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Account;
use App\User;


class AccountBelongsToUser
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
        $user = Auth::user();

        if ($account->owner_id != $user->id) {
            return response("Account doesn't belong to this user!", 403);
        }
        
        return $next($request);
    } 
}