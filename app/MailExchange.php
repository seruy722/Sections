<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailExchange extends Model
{
    protected $fillable = ['name','email_to','email_from','subject','user_id','message'];
}
