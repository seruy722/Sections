<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
           // Schema::drop('schedules');
            $table->increments('id');
            $table->string('days_of_week');
            $table->string('event_name');
            $table->text('event_info');
            $table->time('data_start');
            $table->time('data_end');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}