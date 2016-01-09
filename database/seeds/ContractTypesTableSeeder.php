<?php

use Illuminate\Database\Seeder;

class ContractTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contracttypes')->insert([
            'id' => 1,
            'contract_type' => 'default',
        ]);
    }
}
