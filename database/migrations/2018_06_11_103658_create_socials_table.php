<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialsTable extends Migration
{
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fb');
            $table->string('vk');
            $table->string('tw');
            $table->string('inst');
            $table->integer('section_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('socials');
    }
}
