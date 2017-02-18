<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appid');
            $table->integer('classid');
            $table->integer('instanceid');
            $table->text('icon_url');
            $table->text('icon_url_large');
            $table->string('name');
            $table->string('market_hash_name');
            $table->string('market_name');
            $table->string('type');
            $table->integer('tradable');
            $table->integer('marketable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('all_items');
    }
}
