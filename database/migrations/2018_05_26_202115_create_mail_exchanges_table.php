<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailExchangesTable extends Migration
{
    public function up()
    {
        Schema::create('mail_exchanges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email_to');
            $table->string('email_from');
            $table->string('subject')->nullable();
            $table->text('msg')->nullable();
            $table->boolean('read_it')->default(false);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mail_exchanges');
    }
}
