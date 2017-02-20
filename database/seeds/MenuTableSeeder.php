<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert(['title' => 'Home','father' => 0, 'ability'=>2]);
        DB::table('menu')->insert(['title' => 'Dashboard','father' => 0, 'ability'=>1]);
        DB::table('menu')->insert(['title' => 'Setting','father' => 0, 'ability'=>2]);

        DB::table('menu')->insert(['title' => 'Contest','father' => 1,'url'=>'#/contest/list', 'ability'=>2]);
        DB::table('menu')->insert(['title' => 'Problem','father' => 1,'url'=>'#/problem/list', 'ability'=>2]);
        DB::table('menu')->insert(['title' => 'Status','father' => 1,'url'=>'#/status/list', 'ability'=>2]);

        DB::table('menu')->insert(['title' => 'Contest','father' => 2,'url'=>'#/contest/admin/list', 'ability'=>1]);
        DB::table('menu')->insert(['title' => 'Problem','father' => 2,'url'=>'#/problem/admin/list', 'ability'=>1]);

        DB::table('menu')->insert(['title' => 'Profile','father' => 3,'url'=>'#/user/profile', 'ability'=>2]);
        DB::table('menu')->insert(['title' => 'Account','father' => 3,'url'=>'#/user/account', 'ability'=>1]);
    }
}
