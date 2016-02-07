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
			$table->longText('content');
			$table->integer('creator_id')->length(10)->unsigned()->index();
			$table->integer('contracttype_id')->length(4)->unsigned();
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
