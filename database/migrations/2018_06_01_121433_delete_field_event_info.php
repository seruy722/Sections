<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFieldEventInfo extends Migration
{
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('event_info');
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            //
        });
    }
}
