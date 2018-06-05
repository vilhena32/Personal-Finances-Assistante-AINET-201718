<?php

namespace App;

use App\Account;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    //
    public $timestamps = false;
    protected $table = 'movements';

    public function account()
    {
    	return $this->belongsTo('App\Account');
    }
}
