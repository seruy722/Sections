<?php

namespace App;
use App\Sections;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $table='schedules';

    public function sections() {
        return $this->belongsTo('App\Sections', 'sections_id');
    }
}
