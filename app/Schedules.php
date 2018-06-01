<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{

    protected $fillable = ['section_id', 'day_of_week', 'event_start', 'event_end', 'event_name'];

    public function sections()
    {
        return $this->belongsTo(Sections::class);
    }
}
