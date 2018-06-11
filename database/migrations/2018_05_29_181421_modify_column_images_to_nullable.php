<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnImagesToNullable extends Migration
{
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->string('images')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            //
        });
    }
}
