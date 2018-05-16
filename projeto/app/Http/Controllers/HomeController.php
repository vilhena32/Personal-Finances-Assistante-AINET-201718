<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Movement;
use App\Account;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



     public function index()
    {
        $users = User::all()->count();
        $movements = Movement::all()->count();
        $accounts = Account::all()->count();
        //var_dump($users);

        //$users = User::all();
        
        return view('index', compact('users','movements','accounts'));
    }
}
