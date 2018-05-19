<?php

namespace App;
use App\Users;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $table='schedules';

    public function users() {
        return $this->belongsTo('App\Users', 'users_id');
    }
}
