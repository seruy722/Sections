<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsToNullableInSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('socials', function (Blueprint $table) {
            $table->string('fb')->nullable()->change();
            $table->string('vk')->nullable()->change();
            $table->string('inst')->nullable()->change();
            $table->string('tw')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('socials', function (Blueprint $table) {
            //
        });
    }
}
