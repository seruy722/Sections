<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsToNullableInSocialsTable extends Migration
{
    public function up()
    {
        Schema::table('socials', function (Blueprint $table) {
            $table->string('fb')->nullable()->change();
            $table->string('vk')->nullable()->change();
            $table->string('inst')->nullable()->change();
            $table->string('tw')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('socials', function (Blueprint $table) {
            //
        });
    }
}
