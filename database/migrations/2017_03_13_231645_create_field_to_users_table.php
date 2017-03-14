<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('steam_name');
            $table->string('steam_avatar');
            $table->string('steamid');
            $table->string('steam_profile');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('steam_name');
            $table->dropColumn('steam_avatar');
            $table->dropColumn('steamid');
            $table->dropColumn('steam_profile');
        });
    }
}
