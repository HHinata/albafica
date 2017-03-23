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
        \App\Models\Menu::create(
            [
                'name'=>'个人空间',
                'href'=>'/profile/index'
            ]
        );
        \App\Models\Menu::create(
            [
                'name'=>'消息中心',
                'href'=>'/profile/message'
            ]
        );
        \App\Models\Menu::create(
            [
                'name'=>'公告设置',
                'class' =>  'Manage',
                'href'=>'/profile/notice'
            ]
        );
        \App\Models\Menu::create(
            [
                'name'=>'团队管理',
                'href'=>'/profile/team'
            ]
        );
        \App\Models\Menu::create(
            [
                'name'=>'题库管理',
                'class' =>  'Manage',
                'href'=>'/profile/problem'
            ]
        );
        \App\Models\Menu::create(
            [
                'name'=>'比赛管理',
                'class' =>  'Manage',
                'href'=>'/profile/contest'
            ]
        );
        \App\Models\Menu::create(
            [
                'name'=>'文章管理',
                'href'=>'/profile/post'
            ]
        );
        \App\Models\Menu::create(
            [
                'name'=>'个人设置',
                'href'=>'/profile/setting'
            ]
        );
    }
}
