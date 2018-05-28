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
        $this->middleware('admin', ['only' => ['listusers','search']]);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $id)
    {
          $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id)
    {
     $this->authorize('update', $user);
     $except = ['password'];
        // if (!$user->isAdmin()) {
        //     $except[] = 'type';
        // }
     $user->fill($request->except($except));
     $user->save();

     return redirect()
     ->route('users.index')
     ->with('success', 'User saved successfully');
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()
        ->route('users.index')
        ->with('success', 'User deleted successfully');
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
        dd($users);
        return view('userslist', compact('users'));
    }

    public function getSearch(Request $request)
    {
        $query = trim($request->input('search'));

        $usersBlocked = User::where('name', 'like' ,'%' . $query . '%')->having('blocked', '=', 1)->get();
        $usersUnblocked = User::where('name', 'like' ,'%' . $query . '%')->having('blocked', '=', 0)->get();

        $role = User::where('admin', 'like' ,'%' . $query . '%')->having('blocked', '=', 0)->get();

        $advertisements = Advertisement::where('name', 'like', '%' . $query . '%')->having('blocked', '=', 0)->get();


        $tags = Tag::where('name', 'like', '%' . $query . '%')->having('blocked', '=', 0)->get();
        $adTags = [];
        if(count($tags)){
            $adTags = $tags[0]->advertisements;

        }
       

        return view('farmersmarket.farmersmarket-search',compact(['users','location', 'advertisements', 'adTags']));   

    }

    public function search_block(Request $request)
    {
        $this->authorize('blocked', User::class);
        if ($request->input('name') == ""){
            return redirect()
                ->route('users.blocked');
        }
        $users = User::where($request->input('search_field'), 'like' ,'%'.$request->input('name').'%')
                            ->where('blocked', 1)->orderBy('name', 'asc')->paginate(10);
        //$users = DB::table('users')->where('name', $request->input('name'))->get();
        //dd($users);
        return view('users.blocked', compact('users'));
    }
}