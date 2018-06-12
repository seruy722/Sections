<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'api_token', 'photo','feedback_email'];

    public function sections()
    {
        return $this->hasMany(Sections::class, 'user_id');
    }

    public function news()
    {
        return $this->hasManyThrough(News::class, Sections::class, 'user_id', 'section_id');
    }

}
