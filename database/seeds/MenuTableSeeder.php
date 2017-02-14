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
        DB::table('menu')->insert(['title' => 'Contest','father' => 0,'url'=>'#/contest/list']);
        DB::table('menu')->insert(['title' => 'Contest(#)','father' => 0,'url'=>'#/contest/admin/list']);
        DB::table('menu')->insert(['title' => 'Problem(#)','father' => 0,'url'=>'#/problem/admin/list']);
        DB::table('menu')->insert(['title' => 'Problem','father' => 0,'url'=>'#/problem/list']);
        DB::table('menu')->insert(['title' => 'Status','father' => 0,'url'=>'#/status/list']);
    }
}
