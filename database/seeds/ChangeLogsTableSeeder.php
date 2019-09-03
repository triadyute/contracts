<?php

use Illuminate\Database\Seeder;

class ChangeLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ChangeLog::class, 30)->create();
    }
}
