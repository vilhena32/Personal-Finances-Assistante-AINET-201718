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
     $this->middleware('auth', ['except' => ['index','register','store',]]);
     $this->middleware('auth', ['only' => ['listusers']]);
     $this->middleware('admin', ['only' => ['filter','block','unblock','assignAdmin','removeAdmin','store']]);
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

    public function listUsers()
    {
        $users = User::orderBy('name','asc')->paginate(10);

        return view('userslist', compact('users'));
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


    public function filter(Request $request)
    {
        $validFields= array('search_field','search_status', 'name');

        if($request->input('search_status')=="block")
        {
            $blocked=1;   
        }
        if($request->input('search_status')=="unblock")
        {
            $blocked=0;   
        }

        if($request->input('search_type')=="admin")
        {   
            $admin =1;
        }

        if($request->input('search_type')=="regular")
        {   
            $admin =0;
        }

        if($request->input('search_status')=="none" && $request->input('search_type')=="none")
        {
            $users= User::where('name', 'like' ,'%' . $request->input('name') . '%')
                        ->orderBy('name','asc')
                        ->paginate(10);
            return view('userslist', compact('users'));
        }

        if($request->input('search_status')=="none" && $request->input('search_type')!="none")
        {
            $users= User::where('name', 'like' ,'%' . $request->input('name') . '%')
                        ->where('admin','=' , $admin)
                        ->orderBy('name','asc')
                        ->paginate(10);
            return view('userslist', compact('users'));
        }

        if($request->input('search_status')!="none" && $request->input('search_type')=="none")
        {
            $users= User::where('name', 'like' ,'%' . $request->input('name') . '%')
                        ->where('blocked','=', $blocked)
                        ->orderBy('name','asc')
                        ->paginate(10);
            return view('userslist', compact('users'));
        }


        if($request->input('name')=="")
        {
            $users= User::where('blocked','=' , $blocked)
            ->where('admin','=', $admin)
            ->orderBy('name','asc')
            ->paginate(10);
        }
        else
        {
           $users = User::where('name', 'like' ,'%' . $request->input('name') . '%')
           ->where('blocked','=' , $blocked)
           ->where('admin','=', $admin)
           ->orderBy('name','asc')
           ->paginate(10);
       }

       return view('userslist', compact('users'));
   }

    public function showPublicProfile()
    {
        $users = User::orderBy('name','asc')->paginate(10);

        return view('userslist', compact('users'));
    }
}