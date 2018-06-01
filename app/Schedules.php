<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    public function sections()
    {
        return $this->belongsTo(Sections::class);
    }
}
