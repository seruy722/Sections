<?php

namespace App;
use App\Users;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $table='sections';

    public function users() {
        return $this->belongsTo('App\Users', 'users_id');
    }
}
