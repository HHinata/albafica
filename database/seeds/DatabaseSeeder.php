<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(NewUserSeeder::class);
//         $this->call(RoleTableSeeder::class);
         $this->call(ProblemTableSeeder::class);
//         $this->call(ContestTableSeeder::class);
//         $this->call(StatueTableSeeder::class);
//         $this->call(ContestProblemTableSeeder::class);
//         $this->call(MenuTableSeeder::class);
    }
}
