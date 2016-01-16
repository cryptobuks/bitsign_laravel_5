<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendingSigrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_sigrequests', function(Blueprint $table)
        {
            $table->integer('contract_id')->length(12)->unsigned()->index();
            $table->integer('pending_user_id')->length(12)->unsigned()->index();
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
        Schema::drop('pending_sigrequests');
    }
}
