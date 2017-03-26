<?php

use Illuminate\Database\Seeder;

class NewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        \App\User::create([
            'name' => 'skyfire',
            'email' => '739609084@qq.com',
            'password' => bcrypt('123456'),
            'rating' => rand(0, 1000),
        ]);

        foreach (range(0, 20) as $item)
        {
            \App\User::create([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => $faker->password,
                'rating' => $faker->numberBetween(0, 2000)
            ]);
        }
    }
}
