<?php

use Illuminate\Database\Seeder;

class NewTags extends Seeder
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
            $tag = new \App\Models\Tag();
            $tag->name = $faker->name;
            $tag->save();
        }
    }
}
