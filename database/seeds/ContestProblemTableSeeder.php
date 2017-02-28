<?php

use Illuminate\Database\Seeder;

class ContestProblemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ContestProblem::create([
            'problem_id'=>rand(0, 50),
            'contest_id'=>1,
            'order'=>1,
            'submited'=>rand(100, 200),
            'solved'=>rand(0, 100)
        ]);

        \App\Models\ContestProblem::create([
            'problem_id'=>rand(0, 50),
            'contest_id'=>1,
            'order'=>2,
            'submited'=>rand(100, 200),
            'solved'=>rand(0, 100)
        ]);

        \App\Models\ContestProblem::create([
            'problem_id'=>rand(0, 50),
            'contest_id'=>1,
            'order'=>3,
            'submited'=>rand(100, 200),
            'solved'=>rand(0, 100)
        ]);
    }
}
