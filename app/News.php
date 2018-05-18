<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','description','content','img_filename','user_id','active','created_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
