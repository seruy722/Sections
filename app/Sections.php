<?php

namespace App;
use App\Users;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{


    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function news()
    {
        return $this->hasMany(News::class,'section_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedules::class,'section_id');
    }
}
