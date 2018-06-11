<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DeleteTableFiles extends Migration
{
    public function up()
    {
        Schema::dropIfExists('files');
    }
}
