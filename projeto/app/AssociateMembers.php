<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;
class AssociateMembers extends Model
{
    //
     protected $table = 'associate_members';



    public function associates()
    {
        return $this->belongsTo(User::class);
    }


}
