<?php

use Illuminate\Database\Seeder;

class NewTeams extends Seeder
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
        $faker->addProvider(new Faker\Provider\Image($faker));
        foreach (range(0, 50) as $item)
        {
            $team = new \App\Models\Team();
            $team->name = $faker->name;
            $team->desc = $faker->text($maxNbChars = 5);
            $team->avatar = $faker->imageUrl($width = 640, $height = 480);
            $team->save();
        }
    }
}
