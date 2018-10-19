<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuration', function (Blueprint $table) {
            $table->dropColumn('key');
            $table->dropColumn('value');
            $table->string('name');
            $table->string('brand');
            $table->string('logo');
            $table->string('about_title');
            $table->string('about_subtitle');
            $table->string('about_img');
            $table->string('about_content');
            $table->string('games_title');
            $table->string('games_subtitle');
            $table->string('games_img');
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
            $table->string('key');
            $table->string('value');
            $table->dropColumn('name');
            $table->dropColumn('brand');
            $table->dropColumn('logo');
            $table->dropColumn('about_title');
            $table->dropColumn('about_subtitle');
            $table->dropColumn('about_img');
            $table->dropColumn('about_content');
            $table->dropColumn('games_title');
            $table->dropColumn('games_subtitle');
            $table->dropColumn('games_img');
        });
    }
}
