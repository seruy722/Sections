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
            $table->increments('id');
            $table->string('day_of_week');
            $table->string('event_name');
            $table->text('event_info');
            $table->time('event_start');
            $table->time('event_end');
            $table->integer('section_id')->unsigned();
//            $table->foreign('section_id')->references('id')->on('sections');
//            $table->timestamp('created_at')->useCurrent();
//            $table->timestamp('updated_at')->useCurrent();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}