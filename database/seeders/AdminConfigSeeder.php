<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_config')->truncate();

        \DB::table('admin_config')->insert(
            [
                [
                    'created_at' => '2020-05-31 15:10:40',
                    'description' => '用户头像',
                    'id' => 1,
                    'name' => 'user_avatar',
                    'updated_at' => '2020-05-31 15:10:40',
                    'value' => 'http://blog.witcier.com/media-store/img/witcier_avatar.jpg',
                ],
                [
                    'created_at' => '2020-05-31 15:11:05',
                    'description' => 'Slogin',
                    'id' => 2,
                    'name' => 'user_slogin',
                    'updated_at' => '2020-05-31 15:11:05',
                    'value' => 'Coding For Fun，代码改变世界',
                ],
                [
                    'created_at' => '2020-05-31 15:11:22',
                    'description' => '作者',
                    'id' => 3,
                    'name' => 'username',
                    'updated_at' => '2020-05-31 15:11:22',
                    'value' => 'Witcier',
                ],
                [
                    'created_at' => '2020-06-18 17:20:44',
                    'description' => 'GitHub地址',
                    'id' => 4,
                    'name' => 'user_github',
                    'updated_at' => '2020-06-18 17:20:44',
                    'value' => 'https://github.com/witcier',
                ],
                [
                    'created_at' => '2020-06-18 17:21:17',
                    'description' => '邮箱地址',
                    'id' => 5,
                    'name' => 'user_email',
                    'updated_at' => '2020-06-18 17:21:17',
                    'value' => '770201276@qq.com',
                ],
                [
                    'created_at' => '2020-06-18 17:26:58',
                    'description' => '微信图片地址',
                    'id' => 6,
                    'name' => 'user_wechat',
                    'updated_at' => '2020-06-18 17:27:17',
                    'value' => 'http://blog.witcier.com/media-store/img/QRCode.jpg',
                ],
                [
                    'created_at' => '2020-06-19 16:28:53',
                    'description' => '关于我',
                    'id' => 7,
                    'name' => 'about_me',
                    'updated_at' => '2020-06-24 14:10:39',
                    'value' => '一条啥都不会还不想学习的咸鱼，等待翻身',
                ],
                [
                    'created_at' => '2020-06-19 16:29:11',
                    'description' => '关于本站',
                    'id' => 8,
                    'name' => 'about_site',
                    'updated_at' => '2020-10-20 09:12:19',
                    'value' => '##### 启程

上班时闲逛 Laravel 社区发现了一个很牛的个人博客项目[techflowing-Blog](https://github.com/techflowing/Blog)，就把项目 clone 了，然后部署成功、运行，发现自己的个人博客网站瞬间弱爆了。然后便想着要不然把自己原来的博客网站给干掉吧，然后基于[techflowing-Blog](https://github.com/techflowing/Blog)重新开发一个适合自己的个人博客网站。


##### 改造

* 升级 [Laravel](https://learnku.com/docs/laravel/8.x) 框架为 8.*
* 将 [Laravel-admin](https://laravel-admin.org/) 改成 [Dcat Admin](https://learnku.com/docs/dcat-admin/2.x)
* 本地线上将采用统一环境使用 [Laravel Sail](https://learnku.com/docs/laravel/8.x/sail/9789)
* 打造一个适合自己的博客主题（这个放在最后是因为自己前端知识比较薄弱）


##### 已知问题

1. 浏览器适配（当前仅适配 Chrome）
2. bower install 被执行时会出现个别扩展无法正常安装，建议手动一个个安装

##### 致谢

* [Laravel](https://learnku.com/laravel)
* [WebStack-Laravel](https://github.com/hui-ho/WebStack-Laravel "WebStack-Laravel")
* [Laravel-admin](https://laravel-admin.org/ "Laravel-admin")
* [Editor.md](http://editor.md.ipandao.com/ "Editor.md")
* [Layer ](https://layer.layui.com/ "Layer ")
* [zTree](http://www.treejs.cn/v3/main.php#_zTreeInfo "zTree")
* [SmartWiki](https://github.com/lifei6671/SmartWiki "SmartWiki")
* [Valine](https://valine.js.org/)
* [KityMinder](https://github.com/fex-team/kityminder)
* [Laravel Sail](https://learnku.com/docs/laravel/8.x/sail/9789)
* [Dcat Admin](https://learnku.com/docs/dcat-admin/2.x)',
                ],
                [
                    'created_at' => '2020-06-25 14:29:05',
                    'description' => 'valine_app_id',
                    'id' => 9,
                    'name' => 'valine_app_id',
                    'updated_at' => '2020-06-25 14:29:05',
                    'value' => 'Qbo9OXrWmbsahg21m7A4VKIx-gzGzoHsz',
                ],
                [
                    'created_at' => '2020-06-25 14:29:32',
                    'description' => 'valine_app_key',
                    'id' => 10,
                    'name' => 'valine_app_key',
                    'updated_at' => '2020-06-25 14:29:32',
                    'value' => 'DMbLvtMz659xtt1skJwTK6UG',
                ],
            ]
        );
    }
}
