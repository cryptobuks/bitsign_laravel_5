<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('terms')) {
            Schema::drop('terms');
        }
        Schema::create('terms', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('document_id')->length(12)->unsigned()->index();
            $table->string('term',15);
            $table->string('type',15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('terms');
    }
}
