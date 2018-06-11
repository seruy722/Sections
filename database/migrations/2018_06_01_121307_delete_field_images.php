<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFieldImages extends Migration
{
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }

    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            //
        });
    }
}
