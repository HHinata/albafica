<?php

use Illuminate\Database\Seeder;

class NewProblems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\Lorem($faker));
        $faker->addProvider(new Faker\Provider\Base($faker));
        foreach (range(0, 50) as $item)
        {
            $problem = new \App\Models\Problem();
            $problem->platform = 'hdu';
            $problem->sign = '1000';
            $problem->title = $faker->name;
            $problem->desc = $faker->text($maxNbChars = 500);
            $problem->input = $faker->text($maxNbChars = 200);
            $problem->output = $faker->text($maxNbChars = 200);
            $problem->sample_input = $faker->text($maxNbChars = 200);
            $problem->sample_output = $faker->text($maxNbChars = 200);
            $problem->time_limit = rand(1, 6)*1000;
            $problem->mem_limit = rand(1, 2)*65535;
            $problem->solved = rand(1, 100);
            $problem->submited = rand(100, 200);
            $problem->author = $faker->name;
            $problem->private = false;
            $problem->save();
        }
    }
}
