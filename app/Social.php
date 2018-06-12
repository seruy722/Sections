<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['fb', 'vk', 'inst', 'tw', 'section_id'];
}
