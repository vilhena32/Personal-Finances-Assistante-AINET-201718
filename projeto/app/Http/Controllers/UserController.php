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
       $this->middleware('auth', ['except' => ['index','register','store',]]);
       $this->middleware('auth', ['only' => ['listusers']]);
       $this->middleware('admin', ['only' => ['filter','block','unblock','assignAdmin','removeAdmin']]);
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
      //  dd($request);
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
        }else
        {
         $users = User::where('name', 'like' ,'%' . $request->input('name') . '%')
         ->where('blocked','=' , $blocked)
         ->where('admin','=', $admin)
         ->orderBy('name','asc')
         ->paginate(10);
     }




     return view('userslist', compact('users'));





 }

}