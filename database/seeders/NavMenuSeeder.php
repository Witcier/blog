<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NavMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('nav_menus')->truncate();

        \DB::table('nav_menus')->insert(
            [
                [
                    'created_at' => '2020-04-11 08:17:57',
                    'id' => 1,
                    'name' => '导航站',
                    'order' => 4,
                    'path' => 'navigation',
                    'target' => 0,
                    'updated_at' => '2020-06-25 16:07:52',
                ],
                [
                    'created_at' => '2020-04-11 08:18:15',
                    'id' => 2,
                    'name' => '知识库',
                    'order' => 2,
                    'path' => 'wiki',
                    'target' => 0,
                    'updated_at' => '2020-04-11 10:25:25',
                ],
                [
                    'created_at' => '2020-04-11 08:18:42',
                    'id' => 3,
                    'name' => '博客',
                    'order' => 1,
                    'path' => 'blog',
                    'target' => 0,
                    'updated_at' => '2020-05-31 15:11:43',
                ],
                [
                    'created_at' => '2020-06-18 17:16:08',
                    'id' => 4,
                    'name' => '关于',
                    'order' => 100,
                    'path' => 'about',
                    'target' => 0,
                    'updated_at' => '2020-06-25 15:52:56',
                ],
                [
                    'created_at' => '2020-06-25 14:30:16',
                    'id' => 7,
                    'name' => '留言板',
                    'order' => 99,
                    'path' => 'guestbook',
                    'target' => 0,
                    'updated_at' => '2020-06-25 15:52:48',
                ],
                [
                    'created_at' => '2020-06-25 15:36:22',
                    'id' => 8,
                    'name' => '思维导图',
                    'order' => 3,
                    'path' => 'xmind',
                    'target' => 0,
                    'updated_at' => '2020-06-25 16:07:57',
                ],
            ]
        );
    }
}
