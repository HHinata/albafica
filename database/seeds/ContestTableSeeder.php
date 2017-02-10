<?php

use Illuminate\Database\Seeder;

class ContestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('contest')->insert([
            'title' => 'Hello world contest',
            'description' => 'the first Hello world contest',
            'start_time' => "1486703541",
            'end_time' => "1486503541"
        ]);
    }
}
