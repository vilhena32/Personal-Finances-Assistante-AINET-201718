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

    public function __construct()
    {
        //session_start();

        $this->middleware('auth', ['only' => ['listUsers', 'myAssociates']]);
        //$this->middleware('admin', ['only' => ['listUsers', 'myAssociates']]);
    }

	public function listUsers()
    {   

        $user = User::find(Auth::user()->id); 
        $associates= $user->associates;
        $associatedOf= $user->associateOf;
        //dd($associatedOf);
        $users = User::orderBy('name','asc')->paginate(10);

        
        return view('userslist', compact('users','associates'));
    }


    public function myAssociates()
    {   

        $user = User::find(Auth::user()->id); 
        $associates= $user->associates;
        $users = User::orderBy('name','asc')->paginate(10);

        
        return view('associates.myassociates', compact('users','associates','user'));
    }




    public function showAssociate(User $user)
    {

    	
    	return view('users.showUser','user');
    }


}
 