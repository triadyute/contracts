<?php

use Illuminate\Database\Seeder;

class ContractCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ContractCategory::class, 7)->create();
    }
}
