<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Auth;
use App\User;
use App\AssociateMember;
use Illuminate\Support\Facades\DB;

class AssociateMemberController extends Controller
{
    //

	public function listAssociates()
    {   

        $user = User::find(Auth::user()->id); 
        $associates = $user->associates;
        
        return view('profile', compact('associates','user'));
    }

    public function showAssociate(User $user)
    {
    	
    	return view('users.showUser','user');
    }
}
 