<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageInCategoryTable extends Migration
{
    public function up()
    {
        Schema::table('category', function (Blueprint $table) {
            $table->string('image');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category');
    }
}
