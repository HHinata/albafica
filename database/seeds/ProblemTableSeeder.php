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
        //
        DB::table('problem')->insert([
            'platform' => 'HDU',
            'sign' => '1000',
            'title' => 'A + B Problem',
            'description' => 'Calculate A + B.',
            'input' => 'Each line will contain two integers A and B. Process to end of file.',
            'output' => 'For each case, output A + B in one line.',
            'sample_input' => '1 1',
            'sample_output' => '2'
        ]);
    }
}
