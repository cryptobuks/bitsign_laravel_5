<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filerecords', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('hash', 64);
			$table->string('filename', 100);
			$table->integer('contract_id')->length(14)->unsigned()->index();
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
		Schema::drop('filerecords');
	}

}
