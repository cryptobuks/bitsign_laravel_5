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
        $records = [
        [1, 'Contract', 'Contract'],
        [2, 'IP Record', 'Intellectual Property']
        ];

        foreach ($records as $record) {
            DB::table('contract_types')->insert([
            'id' => $record[0],
            'name' => $record[1],
            'parent' =>$record[2]
            ]);
        }
        
    }
}
