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

    public function getDoc()
    {
    	if ($this->profile_photo==NULL) {
            return asset('storage/docs/default.png');
        } else {
            return asset('storage/docs/'.$this->original_name);
        }
    }
}
