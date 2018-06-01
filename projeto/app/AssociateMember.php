<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class AssociateMember extends Model
{
    //
     protected $table = 'associate_members';


     public function user()
     {
     	return $this->belongsTo('App\User');
     }

     public function getUser($id)
     {	
     	$user = User::find($id);
          //dd($user);
     	return $user;
     }



}
