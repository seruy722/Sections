<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','description','content','image_name','section_id','active','created_at'];

    public function sections()
    {
        return $this->belongsTo(User::class,'section_id');
    }
}
