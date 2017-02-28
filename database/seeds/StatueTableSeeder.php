<?php

use Illuminate\Database\Seeder;

class StatueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $platform = ['hdu', 'poj', 'hat'];

        foreach (range(1, 100) as $item)
        {
            \App\Models\Solution::create([
                'platform'=>$platform[array_rand($platform)],
                'sign'=>rand(1000, 9999),

                'user_id'=>rand(1, 1999),
                'problem_id'=>rand(1000, 9999),
                'contest_id'=>rand(0, 1),

                'code' =>  md5(time()+rand(0, 10000)).md5(time()+rand(0, 10000)),

                'time'=>rand(1, 1999),
                'memory'=>rand(1, 1999),
                'lang'=>rand(0, 3),
                'result'   =>  rand(0, 9)
            ]);
        }
    }
}
