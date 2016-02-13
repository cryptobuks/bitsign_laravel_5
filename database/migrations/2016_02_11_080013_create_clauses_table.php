<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('clauses')) {
            Schema::drop('clauses');
        }
        Schema::create('clauses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('document_id')->length(12)->unsigned()->index();
            $table->longText('content_editing');
            $table->longText('content_approved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clauses');
    }
}
