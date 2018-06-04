<?php

namespace App;
use App\Movement;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $table = 'accounts';

    public function user()
    {
    	return $this->belongsTo('App\User');

    }

    public function movements()
    {
        return $this->hasMany('App\Movement','account_id');
    }

    public function type()
    {
 
    	return $this->hasOne('App\AccountType', 'id','account_type_id');
    }

    public function getStatus()
    {
    	//return $this->delete_at;
    }
}
