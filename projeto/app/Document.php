<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
     protected $table = 'documents';

    public function movements()
    {
        return $this->hasMany('App\Movement','document_id');
    }
}
