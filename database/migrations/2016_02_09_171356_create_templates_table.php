<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('templates')) {
            Schema::drop('templates');
        }
        Schema::create('templates', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title',276);
            $table->char('language', 3);
            $table->boolean('private');
            $table->integer('editor_count')->length(2)->unsigned();
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
        Schema::drop('templates');
    }
}
