<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageGalleriesTable extends Migration
{
    public function up()
    {
        Schema::create('image_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('section_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('image_galleries');
    }
}
