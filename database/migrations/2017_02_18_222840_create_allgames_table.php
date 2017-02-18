<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllgamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name');
            $table->integer('appid')->unique();
            $table->integer('required_age');
            $table->string('is_free');
            $table->text('detailed_description');
            $table->text('about_the_game');
            $table->text('short_description');
            $table->text('supported_languages');
            $table->text('reviews');
            $table->text('header_image');
            $table->string('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('all_games');
    }
}
