<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Auth;
use App\User;
class AssociateMembersController extends Controller
{
    //


    public function profiles()
    {
    	$users= User::has('associates')->get();
    	
    	return view('listUsers', compact('users'));
    }
}
