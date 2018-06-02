<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $fillable = ['name','image'];

    public function sections()
    {
        return $this->hasMany(Sections::class,'category_id');
    }

}
