<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *a
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role','api_token', 'photo'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    
    protected $table='users';

    public function sections()
    {
        return $this->hasMany('App\Sections','user_id');
    }

}
