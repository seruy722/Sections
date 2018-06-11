<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DeleteTableSiteSettings extends Migration
{
    public function up()
    {
        Schema::dropIfExists('site_settings');
    }
}
