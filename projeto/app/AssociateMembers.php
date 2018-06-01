<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class AssociateMembers extends Eloquent
{
    //
     protected $table = 'associate_members';



    public function associates()
    {
       // return $this->has(User);
    }


}
