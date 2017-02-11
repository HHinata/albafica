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
        DB::table('menu')->insert(['title' => 'List','father' => 1,'url'=>'#/contest/list']);
        DB::table('menu')->insert(['title' => 'Detail','father' => 1,'url'=>'#/contest/detail']);
        DB::table('menu')->insert(['title' => 'Rank','father' => 1,'url'=>'#/contest/rank']);
        DB::table('menu')->insert(['title' => 'List','father' => 2,'url'=>'#/problem/list']);
        DB::table('menu')->insert(['title' => 'Detail','father' => 2,'url'=>'#/problem/list']);
        DB::table('menu')->insert(['title' => 'Submit','father' => 2,'url'=>'#/problem/submit']);
        DB::table('menu')->insert(['title' => 'List','father' => 3,'url'=>'#/status/list']);
        DB::table('menu')->insert(['title' => 'Detail','father' => 3,'url'=>'#/status/detail']);
    }
}
