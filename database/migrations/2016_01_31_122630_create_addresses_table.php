<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('addresses')) {
            Schema::drop('addresses');
        }
        Schema::create('addresses', function(Blueprint $table)
        {
            $table->string('line_1',120);
            $table->string('line_2',120);
            $table->string('city',100);
            $table->string('state',50);
            $table->string('country',50);
            $table->string('postalcode',16);
            $table->integer('user_id')->length(10)->unsigned()->index()->unique();
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
        Schema::drop('addresses');
    }
}
