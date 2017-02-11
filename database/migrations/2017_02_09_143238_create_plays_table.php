<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('count', 10, 8);
            $table->integer('pay'); //0 - Выплаты не было, 1 - ожидание, 2 - была
            $table->string('type'); //main - основной, ref - бонус за реф
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
        Schema::drop('plays');
    }
}
