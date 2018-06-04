<?php

namespace App;

use App\Account;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    //
    protected $table = 'movements';

    public function account()
    {
    	return $this->belongsTo('App\Account');
    }
}
