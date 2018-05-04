<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class UserController
{
    public function __construct()
    {
        session_start();
    }


}

?>