<?php


namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Model;
use App\User;
use App\Movement;
use App\Account;




class UserController
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        session_start();
    }



 /*   public function index()
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    	$users = User::all()->count();
    	$movements = Movement::all()->count();
    	$accounts = Account::all()->count();
    	//var_dump($users);

        //$users = User::all();
        return view('index', compact('users'));
    }
*/


}

?>