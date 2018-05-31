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
        'name', 'email', 'password','phone_number', 'photo'
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
        switch ($this->admin) {
            case '1':
                return 'Administrator';
            case '0':
                return 'Registered';
        }

        return 'Anonymous';
    }

    public function getStatus()
    {   
         switch ($this->blocked) {
            case '0':
                return 'Unblocked';
            case '1':
                return 'Blocked';
        }

        return 'Anonymous';
  
    }
    public function getPhoto(){
        if ($this->profile_photo==NULL) {
            return "No Profile Picture to Dysplay";
        }
        else{
         return asset($this->profile_photo);
        }
    }




   


}
