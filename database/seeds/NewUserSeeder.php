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
        //
        \App\User::create([
            'name' => 'skyfire',
            'email' => '739609084@qq.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
