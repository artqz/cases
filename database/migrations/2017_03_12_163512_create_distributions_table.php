<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('players');
            $table->integer('joined_players');
            $table->float('price');
            $table->integer('type');
            $table->integer('status');
            $table->integer('user_id');
            $table->integer('user_winner_id');
            $table->string('game_name');
            $table->string('game_image');
            $table->integer('game_id');
            $table->string('item_name');
            $table->string('item_image');
            $table->integer('item_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('distributions');
    }
}
