<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration {

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
			$table->string('title',60);
			$table->longText('clauses');
			$table->longText('terms');
			$table->longText('parties');
			$table->longText('attachments');
			$table->integer('creator_id')->length(10)->unsigned()->index();
			$table->char('language', 3);
            $table->boolean('private');
            $table->integer('editor_count')->length(2)->unsigned();
			$table->string('key_enc',244);
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
