<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class siteSettings extends Model
{
    protected $fillable = ['img_logo','main_img','main_header','copyright'];
}
