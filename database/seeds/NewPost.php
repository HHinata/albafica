<?php

use Illuminate\Database\Seeder;

class NewPost extends Seeder
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
            $post = new \App\Models\Post();
            $post->title = $faker->name;
            $post->content = $faker->realText($maxNbChars = 1000, $indexSize = 4);
            $post->user_id = rand(1, 20);
            $post->private = false;
            $post->save();
        }
    }
}
