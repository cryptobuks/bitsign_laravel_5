<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('tokens')) {
            Schema::drop('tokens');
        }
        Schema::create('tokens', function(Blueprint $table)
        {
            $table->integer('owner_id')->length(12)->unsigned()->index();
            $table->string('service',15);
            $table->string('token',40);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tokens');
    }
}
