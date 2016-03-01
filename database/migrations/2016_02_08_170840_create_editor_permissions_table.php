<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditorPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('editor_permissions')) {
            Schema::drop('editor_permissions');
        }
        Schema::create('editor_permissions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('editor_id')->length(12)->unsigned()->index();
            $table->integer('template_id')->length(12)->unsigned()->index();
            $table->string('key_enc', 684);
            $table->boolean('accepted');
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
        Schema::drop('editor_permissions');
    }
}
