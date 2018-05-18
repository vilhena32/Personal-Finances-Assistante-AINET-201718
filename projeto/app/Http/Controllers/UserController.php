<?php


namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
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
        $this->middleware('auth', ['except' => ['index','register','store','listUsers']]);
    }
/*
    public function register()
    {
        $user= new User();
        return view('register');
    }
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *//* Inutil
    public function create()
    {
        $user= new User();
        //return view('register');
        return view('register', compact('user'));
    }

    public function store(RegisterUserRequest $request)
    {
        $data = $request()->validate();

        User::create($data);

        return view('home');
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listUsers()
    {
        $users = User::orderBy('name','asc')->paginate(10);

        return view('userslist', compact('users'));
    }
}