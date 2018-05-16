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
        $this->middleware('auth', ['except' => ['index','register','store']]);
    }


   

    public function register()
    {
        $user= new User();
        return view('register');
    }
/*
    public function store()
    {
<<<<<<< HEAD
=======
        $data= $request()->validated();
        $data['password']->Hash::make($data['password']);

        User::create($data);


        return view('index');
    }



>>>>>>> 06cb59df345acbf887c1d274ee7a054dbb98f5b1

    }*/
}

