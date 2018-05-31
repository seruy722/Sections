<?php

namespace App;
use App\Sections;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    public function sections() {
        return $this->belongsTo('App\Sections');
    }
}
