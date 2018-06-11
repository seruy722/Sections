<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('section_name');
            $table->text('info');
            $table->string('images');
            $table->string('img_logo');
            $table->string('address');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
