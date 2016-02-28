<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasTable('contracts')) {
            Schema::drop('contracts');
        }
		Schema::create('contracts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title',276);
			$table->longText('clauses');
			$table->longText('terms');
			$table->longText('parties');
			$table->longText('attachments');
			$table->integer('creator_id')->length(10)->unsigned()->index();
			$table->string('key_enc',244);
			$table->char('hash', 64);
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
		Schema::drop('contracts');
	}

}
