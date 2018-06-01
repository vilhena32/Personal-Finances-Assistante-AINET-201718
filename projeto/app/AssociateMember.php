<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class AssociateMember extends Model
{
    //
     protected $table = 'associate_members';


     public function user()
     {
     	return $this->belongsTo('App\User','associated_main_user');
     }




}
