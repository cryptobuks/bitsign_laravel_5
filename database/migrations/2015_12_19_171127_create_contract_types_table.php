<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('contract_types')) {
            Schema::drop('contract_types');
        }
        Schema::create('contract_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);
<<<<<<< HEAD:database/migrations/2015_12_19_171127_create_contracttypes_table.php
=======
            $table->string('parent',30);
>>>>>>> b67fff2e41930d0af9de9bc3f79e4a7eb66f7ded:database/migrations/2015_12_19_171127_create_contract_types_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contract_types');
    }
}
