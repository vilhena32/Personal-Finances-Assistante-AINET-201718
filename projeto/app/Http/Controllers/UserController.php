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
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //session_start();
        $this->middleware('auth', ['except' => ['index','register','store']]);
        $this->middleware('admin', ['except' => ['index','register','store','listUsers']]);
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

    public function changePassword()
    {
        return view('profile');
    }

    public function updateProfile()
    {
        return view('profile');
    }    

    public function myProfile()
    {
        return view('profile');
    } 


    public function showProfile()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function search(Request $request){
        $validFields = array('name', 'email');
        if ($request->input('name') == ""  || !(in_array($request->input('search_field'), $validFields))){
            return redirect('users');
        }
        $users = User::where($request->input('search_field'), 'like' ,'%'.$request->input('name').'%')->orderBy('name', 'asc')->paginate(10);
        //$users = DB::table('users')->where('name', $request->input('name'))->get();
        //dd($users);
        return view('listusers', compact('users'));
    }
}