<?php

use Illuminate\Database\Seeder;

class ProblemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platform = ['hdu', 'poj', 'hat'];

        foreach (range(1, 200) as $item)
        {
            \App\Models\Problem::create([
                'platform'=>$platform[array_rand($platform)],
                'sign'=>rand(1000, 9999),
                'title' =>  md5(time()+rand(0, 10000)),
                'desc' =>  md5(time()+rand(0, 10000)).md5(time()+rand(0, 10000)),
                'input' =>  md5(time()+rand(0, 10000)).md5(time()+rand(0, 10000)),
                'output' =>  md5(time()+rand(0, 10000)).md5(time()+rand(0, 10000)),
                'sample_input' =>  md5(time()+rand(0, 10000)).md5(time()+rand(0, 10000)),
                'sample_output' =>  md5(time()+rand(0, 10000)).md5(time()+rand(0, 10000)),
                'solved'    =>  rand(0, 100),
                'submited'  =>  rand(100, 200),
                'private'   =>  rand(0, 1)
            ]);
        }
    }
}
