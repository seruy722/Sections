<?php

namespace App;
use App\Sections;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','description','content','image_name','section_id','active'];

    public function sections()
    {
        return $this->belongsTo(Sections::class,'section_id');
    }
}
