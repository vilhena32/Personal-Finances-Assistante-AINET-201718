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

        $associatesOf= $user->associatesOf;
        //dd($associatesOf);
        $users = User::orderBy('name','asc')->paginate(10);

        
        return view('profile', compact('users','associates','associatesOf'));
    }


    public function myAssociates()
    {   

        $user = User::find(Auth::user()->id); 
        $associates= $user->associates;
        //dd($associates);
        //$users = User::orderBy('name','asc')->paginate(10);

        
        return view('associates.myassociates', compact('associates','user'));
    }

    public function myAssociateOf()
    {   

        $user = User::find(Auth::user()->id); 
        $associates= $user->associatesOf;
       
        //$users = User::orderBy('name','asc')->paginate(10);

        
        return view('associates.myassociates', compact('associates','user'));
    }




    public function showAssociate(User $user)
    {

    	
    	return view('users.showUser','user');
    }


}
 