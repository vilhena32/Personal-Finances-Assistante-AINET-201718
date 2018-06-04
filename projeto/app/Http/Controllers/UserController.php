<?php

namespace App\Http\Controllers;

use Model;
use App\User;
use App\Movement;
use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        //session_start();
        $this->middleware('auth', ['except' => ['index','register','store']]);
        $this->middleware('auth', ['only' => ['showPublicProfile']]);
        $this->middleware('admin', ['only' => ['filter','block','unblock','assignAdmin','removeAdmin','store','listUsers']]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view('profile',compact('user'));
    }


    public function edit()
    {
        $user= Auth::user();
        return view('auth.edit-user',compact('user'));
    }

    public function store(UpdateUserRequest $request, User $user)
    {
        $except = ['password','email','photo','phone'];

        $user= User::where('id','=',$user);
        $user->fill($request->except($except));
        $user->save();

        return redirect()
            ->route('listUsers')
            ->with('success', 'User saved successfully');
    }


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

    public function changePassword()
    {
        $user = Auth::user();

        return view('auth.passwords.change');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->get('old_password'), Auth::user()->password)) {
            return redirect()
            ->back()
            ->with("error","The password you provided is not the same as your old password. Please try again.");
        }

        if(strcmp($request->get('old_password'), $request->get('password')) == 0){
            return redirect()
            ->back()
            ->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        
        $data = $request->validated();

        $user = Auth::user();
        $user->password = Hash::make($data['password']);
        $user->save();
        
        return redirect()->route('file');
    }

    public function updateProfile()
    {
        return view('profile');
    }    

    public function myProfile()
    {
        return view('profile');
    }


    public function block(User $user)
    {
        if(Auth::user()->id != $user->id)
        {
            $user->blocked = 1;
            $user->save();

            return redirect()
                ->route('listUsers')
                ->with('success', 'User block successfully');
        }
    }


    public function unblock(User $user)
    {   
        if(Auth::user()->id != $user->id)
        {
            $user->blocked = 0;
            $user->save();

            return redirect()
                ->route('listUsers')
                ->with('success', 'User block successfully');
        }
    }


    public function assignAdmin(User $user)
    {
        if(Auth::user()->id != $user->id)
        {
            $user->admin = 1;
            $user->save();

            return redirect()
                ->route('listUsers')
                ->with('success', 'User assigned successfully');
        }
    }


    public function removeAdmin(User $user)
    {
        if(Auth::user()->id != $user->id)
        {
            $user->admin = 0;
            $user->save();

            return redirect()
                ->route('listUsers')
                ->with('success', 'User removed successfully');
        }
    }


    public function showProfile()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }


    public function filter()
    {
        if (empty($_GET)) {
            $users = User::orderBy('name','asc')->paginate(10);

            return view('userslist', compact('users'));
        } else {
            if ($_GET['status'] == "blocked") {
                $status = 1;
            }

            if ($_GET['status'] == "unblocked") {
                $status = 0;
            }

            if ($_GET['type'] == "admin") {
                $type = 1;
            }

            if ($_GET['type'] == "normal") {  
                $type = 0;
            }

            if (isset($_GET['name'])) {
                $name = $_GET['name'];
            }

            if (!isset($status) && !isset($type)) {
                $users= User::where('name', 'like' ,'%' . $name . '%')
                            ->orderBy('name','asc')
                            ->paginate(10);

                return view('userslist', compact('users'));
            }

            if (!isset($status) && isset($type)) {
                $users= User::where('name', 'like' ,'%' . $name . '%')
                            ->where('admin','=' , $type)
                            ->orderBy('name','asc')
                            ->paginate(10);

                return view('userslist', compact('users'));
            }

            if (isset($status) && !isset($type)) {
                $users= User::where('name', 'like' ,'%' . $name . '%')
                            ->where('blocked','=', $status)
                            ->orderBy('name','asc')
                            ->paginate(10);

                return view('userslist', compact('users'));
            }

            if (!isset($name)) {
                $users= User::where('blocked','=' , $status)
                            ->where('admin','=', $type)
                            ->orderBy('name','asc')
                            ->paginate(10);
            } else {
               $users = User::where('name', 'like' ,'%' . $name . '%')
                            ->where('blocked','=' , $status)
                            ->where('admin','=', $type)
                            ->orderBy('name','asc')
                            ->paginate(10);
            }

           return view('userslist', compact('users'));
        }
    }

    public function showPublicProfile()
    {
        $users = User::orderBy('name','asc')->paginate(10);

        return view('userslist', compact('users'));
    }
}