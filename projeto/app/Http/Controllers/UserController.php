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
        $this->middleware('auth', ['only' => ['PublicProfile','associates','filterAuth','filter']]);
        $this->middleware('admin', ['only' => ['block','unblock','promote','demote','store']]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user = User::find($id);
        $associates= $user->associates;
        $associateOf= $user->associatesOf;

        return view('profile',compact('user','associates','associateOf'));
    }

    public function myProfile()
    {
        $user = Auth::user();
        return view('users.showUser',compact('user'));
    }


    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit-user',compact('user'));
    }

    public function store(Request $request)
    {
        $except = ['password','email','photo','phone'];
       
        $user= Auth::user();

        if($request->input('name')!= "")
        {
            $user->name = $request->input('name');
        }

        if($request->input('email')!= null)
        {
            $user->email = $request->input('email');
        }

        if($request->input('phone')!= null)
        {
            $user->email = $request->input('phone');
        }

       

        $user->save();

        return redirect()
            ->route('home')
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


    public function promote(User $user)
    {
        if(Auth::user()->id != $user->id)
        {
            $user->admin = 1;
            $user->save();

            return redirect()
                ->route('users.search')
                ->with('success', 'User assigned successfully');
        }
    }


    public function demote(User $user)
    {
        if(Auth::user()->id != $user->id)
        {
            $user->admin = 0;
            $user->save();

            return redirect()
                ->route('users.search')
                ->with('success', 'User removed successfully');
        }
    }


    public function showProfile()
    {
        $user = Auth::user();
        $associates = $user->associates;
        dd($associates);

        return view('profile', compact('user','associates'));
    }


    public function filter(Request $request)
    {   
       // dd($request);
        if ($request->input('name') == NULL && $request->input('status') == "" && $request->input('type') == "") {   
            $users = User::orderBy('name','asc')->paginate(10);
            foreach ($users as $user) {
                $user->associates=$user->associates();
                $user->associatesOf=$user->associatesOf();
            }
            //dd($users);
            if(Auth::user()->isAdmin()){
                return view('userslist', compact('users'));
            } else {
             return view('profile',compact('users'));
            }
        } else {
            if ($request->input('status') == "blocked") {
                $status = 1;
            }

            if ($request->input('status') == "unblocked") {
                $status = 0;
            }

            if ($request->input('type') == "admin") {
                $type = 1;
            }

            if ($request->input('type') == "regular") {  
                $type = 0;
            }

            if ($request->input('name') != null) {
                $name = $request->input('name');
            }

            if (!isset($status) && !isset($type)) {
                $users= User::where('name', 'like' ,'%' . $name . '%')
                            ->orderBy('name','asc')
                            ->paginate(10);
                if(Auth::user()->isAdmin()){
                    return view('userslist', compact('users'));
                }
                else{
                 return view('profile',compact('users'));
                }
            }

            if (!isset($status) && isset($type)) {
                $users= User::where('name', 'like' ,'%' . $name . '%')
                            ->where('admin','=' , $type)
                            ->orderBy('name','asc')
                            ->paginate(10);
                if(Auth::user()->isAdmin()){
                    return view('userslist', compact('users'));
                }
                else{
                 return view('profile',compact('users'));
                }
            }

            if (isset($status) && !isset($type)) {
                $users= User::where('name', 'like' ,'%' . $name . '%')
                            ->where('blocked','=', $status)
                            ->orderBy('name','asc')
                            ->paginate(10);

            if(Auth::user()->isAdmin()){
                    return view('userslist', compact('users'));
                }
                else{
                 return view('profile',compact('users'));
                }
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
            if(Auth::user()->isAdmin()){
                    return view('userslist', compact('users'));
                }
                else{
                 return view('profile',compact('users'));
                }
        }
    }

    public function listUsers()
    {   
        $users = User::orderBy('name','asc')->paginate(10);
        return view ('userslist',compact('users'));
    }

    public function showPublicProfile()
    {
        $users = User::orderBy('name','asc')->paginate(10);

        return view('userslist', compact('users'));
    }



    public function filterAuth(Request $request)
    {   
       // dd($request);
        if ($request->input('name')== NULL) {
            $users = User::orderBy('name','asc')->paginate(10);
            //dd($users);
            return view('userslist', compact('users'));
        } else {
            
            $name = $request->input('name');
            
            $users= User::where('name', 'like' ,'%' . $name . '%')
                        ->orderBy('name','asc')
                        ->paginate(10);
            

            if (!isset($name)) 
            {
                $users= User::where('blocked','=' , $status)
                            ->where('admin','=', $type)
                            ->orderBy('name','asc')
                            ->paginate(10);
            }
        
        }
    }
}