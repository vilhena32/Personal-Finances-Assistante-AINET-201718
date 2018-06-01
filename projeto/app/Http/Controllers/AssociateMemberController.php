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
        $associates= $user->associates;
        $associatedOf= $user->associateOf;
        //dd($associatedOf);
        $users = User::orderBy('name','asc')->paginate(10);

        
        return view('profile', compact('users','associates'));
    }

    public function showAssociate(User $user)
    {

    	
    	return view('users.showUser','user');
    }
}
 