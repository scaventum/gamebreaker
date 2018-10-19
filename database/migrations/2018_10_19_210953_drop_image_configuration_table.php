<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropImageConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuration', function (Blueprint $table) {
            $table->dropColumn('about_img');
            $table->dropColumn('games_img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuration', function (Blueprint $table) {
            $table->string('about_img');
            $table->string('games_img');
        });
    }
}
