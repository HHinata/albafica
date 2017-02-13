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
        DB::table('menu')->insert(['title' => 'Contest','father' => 0,]);
        DB::table('menu')->insert(['title' => 'Problem','father' => 0,]);
        DB::table('menu')->insert(['title' => 'Status','father' => 0,]);
        DB::table('menu')->insert(['title' => 'Index','father' => 1,'url'=>'#/contest/list']);
        DB::table('menu')->insert(['title' => 'Dashboard','father' => 1,'url'=>'#/contest/admin/list']);

        DB::table('menu')->insert(['title' => 'Dashboard','father' => 2,'url'=>'#/problem/admin/list']);
        DB::table('menu')->insert(['title' => 'Index','father' => 2,'url'=>'#/problem/list']);

        DB::table('menu')->insert(['title' => 'Index','father' => 3,'url'=>'#/status/list']);
    }
}
