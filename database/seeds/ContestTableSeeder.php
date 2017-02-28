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
        foreach (range(1, 50) as $item)
        {
            \App\Models\Contest::create([
                'title' =>  md5(time()+rand(0, 10000)),
                'desc' =>  md5(time()+rand(0, 10000)).md5(time()+rand(0, 10000)),
                'start_time'    =>  rand(0, 10000000),
                'end_time'    =>  rand(0, 10000000),
                'private'   =>  rand(0, 1)
            ]);
        }
    }
}
