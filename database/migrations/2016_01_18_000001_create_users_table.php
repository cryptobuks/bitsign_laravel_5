<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::drop('users');
        }
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name',50);
            $table->string('l_name',50);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('key_enc', 244);
            $table->string('signkeyname_enc', 244);
            $table->string('pubkey', 32);
            $table->boolean('registered');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
