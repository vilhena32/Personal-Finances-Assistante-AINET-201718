<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Model;
use App\User;
use App\Movement;
use App\Account;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        //session_start();
        $this->middleware('auth', ['except' => ['index','register']]);
    }


    public function index()
    {
    	$users = User::all()->count();
    	$movements = Movement::all()->count();
    	$accounts = Account::all()->count();
    	//var_dump($users);

        //$users = User::all();
        
        return view('index', compact('users','movements','accounts'));
    }

    public function register()
    {
        $user= new User();
        return view('register');
    }
/*
    public function store()
    {

    }*/
}

