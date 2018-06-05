<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone', 'profile_photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function getType()
    {   
        return $this->admin ? 'Administrator' : 'Regular';
    }

    public function getStatus()
    {   
        return $this->blocked ? 'Blocked' : 'Unblocked';
  
    }
    public function getPhoto(){
        if ($this->profile_photo==NULL) {
            return asset('storage/profiles/default.png');
        }
        else{
         return asset('storage/profiles/'.$this->profile_photo);
        }
    }



    public function associates()
    {
        
        return $this->belongsToMany('App\User','associate_members','main_user_id','associated_user_id')->withPivot('created_at');
    }

    public function accounts()
    {
        return $this->hasMany('App\Account','owner_id');
    }

    public function associatedOf()
    {
        
        //return $this->belongsToMany('App\User','associate_members','main_user_id','this->id')->withPivot('created_at');
    }

    

}
