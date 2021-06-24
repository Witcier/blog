<?php

namespace Database\Seeders;

use Dcat\Admin\Models;
use Illuminate\Database\Seeder;
use DB;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        Models\Menu::truncate();
        Models\Menu::insert(
            [
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "extension" => "",
                    "icon" => "feather icon-bar-chart-2",
                    "id" => 1,
                    "order" => 1,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "Index",
                    "updated_at" => NULL,
                    "uri" => "/"
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "extension" => "",
                    "icon" => "feather icon-settings",
                    "id" => 2,
                    "order" => 9,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "Admin",
                    "updated_at" => "2021-06-22 11:30:59",
                    "uri" => ""
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "extension" => "",
                    "icon" => "",
                    "id" => 3,
                    "order" => 10,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Users",
                    "updated_at" => "2021-06-22 11:30:59",
                    "uri" => "auth/users"
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "extension" => "",
                    "icon" => "",
                    "id" => 4,
                    "order" => 11,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Roles",
                    "updated_at" => "2021-06-22 11:30:59",
                    "uri" => "auth/roles"
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "extension" => "",
                    "icon" => "",
                    "id" => 5,
                    "order" => 12,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Permission",
                    "updated_at" => "2021-06-22 11:30:59",
                    "uri" => "auth/permissions"
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "extension" => "",
                    "icon" => "",
                    "id" => 6,
                    "order" => 13,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Menu",
                    "updated_at" => "2021-06-22 11:30:59",
                    "uri" => "auth/menu"
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "extension" => "",
                    "icon" => "",
                    "id" => 7,
                    "order" => 14,
                    "parent_id" => 2,
                    "show" => 1,
                    "title" => "Extensions",
                    "updated_at" => "2021-06-22 11:30:59",
                    "uri" => "auth/extensions"
                ],
                [
                    "created_at" => "2021-06-16 15:55:03",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 8,
                    "order" => 3,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "导航-分类",
                    "updated_at" => "2021-06-17 16:46:00",
                    "uri" => "navigation/categories"
                ],
                [
                    "created_at" => "2021-06-16 17:18:59",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 9,
                    "order" => 4,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "网站管理",
                    "updated_at" => "2021-06-17 16:46:00",
                    "uri" => "navigation/sites"
                ],
                [
                    "created_at" => "2021-06-17 09:22:44",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 10,
                    "order" => 5,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "Wiki管理",
                    "updated_at" => "2021-06-17 16:46:00",
                    "uri" => "wiki"
                ],
                [
                    "created_at" => "2021-06-17 16:45:51",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 11,
                    "order" => 2,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "首页菜单",
                    "updated_at" => "2021-06-17 16:46:00",
                    "uri" => "nav"
                ],
                [
                    "created_at" => "2021-06-17 17:17:09",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 12,
                    "order" => 6,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "配置管理",
                    "updated_at" => "2021-06-17 17:17:17",
                    "uri" => "config"
                ],
                [
                    "created_at" => "2021-06-18 14:53:44",
                    "extension" => "",
                    "icon" => NULL,
                    "id" => 13,
                    "order" => 7,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "媒体库",
                    "updated_at" => "2021-06-18 14:54:26",
                    "uri" => "media"
                ],
                [
                    "created_at" => "2021-06-22 11:26:57",
                    "extension" => "celaraze.dcat-extension-plus",
                    "icon" => "feather icon-settings",
                    "id" => 14,
                    "order" => 8,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "后台设置",
                    "updated_at" => "2021-06-22 11:30:59",
                    "uri" => "dcat-plus/site"
                ],
                [
                    "created_at" => "2021-06-22 12:08:50",
                    "extension" => "dcat-admin.files-manger",
                    "icon" => "feather icon-file-minus",
                    "id" => 19,
                    "order" => 15,
                    "parent_id" => 0,
                    "show" => 1,
                    "title" => "文件管理",
                    "updated_at" => "2021-06-22 12:08:50",
                    "uri" => ""
                ],
                [
                    "created_at" => "2021-06-22 12:08:51",
                    "extension" => "dcat-admin.files-manger",
                    "icon" => "feather icon-align-justify",
                    "id" => 20,
                    "order" => 16,
                    "parent_id" => 19,
                    "show" => 1,
                    "title" => "文件列表",
                    "updated_at" => "2021-06-22 12:08:51",
                    "uri" => "media"
                ]
            ]
        );

        Models\Permission::truncate();
        Models\Permission::insert(
            [
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "http_method" => "",
                    "http_path" => "",
                    "id" => 1,
                    "name" => "Auth management",
                    "order" => 1,
                    "parent_id" => 0,
                    "slug" => "auth-management",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "http_method" => "",
                    "http_path" => "/auth/users*",
                    "id" => 2,
                    "name" => "Users",
                    "order" => 2,
                    "parent_id" => 1,
                    "slug" => "users",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "http_method" => "",
                    "http_path" => "/auth/roles*",
                    "id" => 3,
                    "name" => "Roles",
                    "order" => 3,
                    "parent_id" => 1,
                    "slug" => "roles",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "http_method" => "",
                    "http_path" => "/auth/permissions*",
                    "id" => 4,
                    "name" => "Permissions",
                    "order" => 4,
                    "parent_id" => 1,
                    "slug" => "permissions",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "http_method" => "",
                    "http_path" => "/auth/menu*",
                    "id" => 5,
                    "name" => "Menu",
                    "order" => 5,
                    "parent_id" => 1,
                    "slug" => "menu",
                    "updated_at" => NULL
                ],
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "http_method" => "",
                    "http_path" => "/auth/extensions*",
                    "id" => 6,
                    "name" => "Extension",
                    "order" => 6,
                    "parent_id" => 1,
                    "slug" => "extension",
                    "updated_at" => NULL
                ]
            ]
        );

        Models\Role::truncate();
        Models\Role::insert(
            [
                [
                    "created_at" => "2021-06-15 10:04:17",
                    "id" => 1,
                    "name" => "Administrator",
                    "slug" => "administrator",
                    "updated_at" => "2021-06-15 10:04:18"
                ]
            ]
        );

        Models\Setting::truncate();
		Models\Setting::insert(
			[
                [
                    "created_at" => "2021-06-22 11:38:13",
                    "slug" => "footer_remove",
                    "updated_at" => "2021-06-22 11:38:13",
                    "value" => "1"
                ],
                [
                    "created_at" => "2021-06-22 11:38:14",
                    "slug" => "grid_row_actions_right",
                    "updated_at" => "2021-06-22 11:38:14",
                    "value" => "0"
                ],
                [
                    "created_at" => "2021-06-22 11:38:13",
                    "slug" => "sidebar_style",
                    "updated_at" => "2021-06-23 09:38:06",
                    "value" => "default"
                ],
                [
                    "created_at" => "2021-06-22 11:28:01",
                    "slug" => "site_debug",
                    "updated_at" => "2021-06-22 11:28:01",
                    "value" => "0"
                ],
                [
                    "created_at" => "2021-06-22 11:28:01",
                    "slug" => "site_lang",
                    "updated_at" => "2021-06-22 11:28:01",
                    "value" => "zh_CN"
                ],
                [
                    "created_at" => "2021-06-22 11:28:00",
                    "slug" => "site_logo",
                    "updated_at" => "2021-06-23 11:29:50",
                    "value" => ""
                ],
                [
                    "created_at" => "2021-06-22 11:28:00",
                    "slug" => "site_logo_mini",
                    "updated_at" => "2021-06-22 11:28:00",
                    "value" => ""
                ],
                [
                    "created_at" => "2021-06-22 11:28:00",
                    "slug" => "site_logo_text",
                    "updated_at" => "2021-06-22 11:29:14",
                    "value" => "Witcier"
                ],
                [
                    "created_at" => "2021-06-22 11:28:00",
                    "slug" => "site_title",
                    "updated_at" => "2021-06-22 11:29:14",
                    "value" => "Witcier"
                ],
                [
                    "created_at" => "2021-06-22 11:28:00",
                    "slug" => "site_url",
                    "updated_at" => "2021-06-22 11:29:14",
                    "value" => "http://127.0.0.1/"
                ],
                [
                    "created_at" => "2021-06-22 11:38:13",
                    "slug" => "theme_color",
                    "updated_at" => "2021-06-22 11:38:38",
                    "value" => "default"
                ]
            ]
		);

		Models\Extension::truncate();
		Models\Extension::insert(
			[
                [
                    "created_at" => "2021-06-22 11:26:57",
                    "id" => 1,
                    "is_enabled" => 1,
                    "name" => "celaraze.dcat-extension-plus",
                    "options" => NULL,
                    "updated_at" => "2021-06-22 11:27:23",
                    "version" => "1.1.1"
                ],
                [
                    "created_at" => "2021-06-22 12:08:51",
                    "id" => 4,
                    "is_enabled" => 1,
                    "name" => "dcat-admin.files-manger",
                    "options" => NULL,
                    "updated_at" => "2021-06-22 12:09:03",
                    "version" => "1.0.1"
                ]
            ]
		);

		Models\ExtensionHistory::truncate();
		Models\ExtensionHistory::insert(
			[
                [
                    "created_at" => "2021-06-22 11:26:57",
                    "detail" => "原始版本发布",
                    "id" => 1,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:26:57",
                    "version" => "1.0.0"
                ],
                [
                    "created_at" => "2021-06-22 11:26:57",
                    "detail" => "增加调试模式开关 & 侧栏子菜单缩进增加",
                    "id" => 2,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:26:57",
                    "version" => "1.0.1"
                ],
                [
                    "created_at" => "2021-06-22 11:26:58",
                    "detail" => "扩展表单字段 selectCreate 为 select 字段的升级版，支持快速创建。",
                    "id" => 3,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:26:58",
                    "version" => "1.0.2"
                ],
                [
                    "created_at" => "2021-06-22 11:26:58",
                    "detail" => "增加扩展图标和别名。",
                    "id" => 4,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:26:58",
                    "version" => "1.0.3"
                ],
                [
                    "created_at" => "2021-06-22 11:26:59",
                    "detail" => "增加表单提交预处理过滤，防止XSS攻击。",
                    "id" => 5,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:26:59",
                    "version" => "1.0.4"
                ],
                [
                    "created_at" => "2021-06-22 11:26:59",
                    "detail" => "优化表单提交预处理过滤，不再依赖第三方包。",
                    "id" => 6,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:26:59",
                    "version" => "1.0.5"
                ],
                [
                    "created_at" => "2021-06-22 11:27:00",
                    "detail" => "selectCreate组件的颜色改为主题色。",
                    "id" => 7,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:00",
                    "version" => "1.0.6"
                ],
                [
                    "created_at" => "2021-06-22 11:27:00",
                    "detail" => "UI增加表格行操作按钮紧贴最右侧。",
                    "id" => 8,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:00",
                    "version" => "1.0.6"
                ],
                [
                    "created_at" => "2021-06-22 11:27:00",
                    "detail" => "支持DcatAdmin 2.0.18beta。",
                    "id" => 9,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:00",
                    "version" => "1.0.7"
                ],
                [
                    "created_at" => "2021-06-22 11:27:00",
                    "detail" => "暂时移除侧栏菜单子菜单缩进（不兼容）。",
                    "id" => 10,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:00",
                    "version" => "1.0.7"
                ],
                [
                    "created_at" => "2021-06-22 11:27:01",
                    "detail" => "增加水平菜单选项。",
                    "id" => 11,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:01",
                    "version" => "1.0.7"
                ],
                [
                    "created_at" => "2021-06-22 11:27:01",
                    "detail" => "原先的头部块状显示改为边距优化",
                    "id" => 12,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:01",
                    "version" => "1.0.7"
                ],
                [
                    "created_at" => "2021-06-22 11:27:01",
                    "detail" => "提供了自定义颜色的支持入口",
                    "id" => 13,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:01",
                    "version" => "1.0.8"
                ],
                [
                    "created_at" => "2021-06-22 11:27:02",
                    "detail" => "移除HTML、JS过滤",
                    "id" => 14,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:02",
                    "version" => "1.0.9"
                ],
                [
                    "created_at" => "2021-06-22 11:27:02",
                    "detail" => "移除部分UI优化",
                    "id" => 15,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:02",
                    "version" => "1.0.9"
                ],
                [
                    "created_at" => "2021-06-22 11:27:02",
                    "detail" => "修复debug配置无效的问题",
                    "id" => 16,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:02",
                    "version" => "1.1.0"
                ],
                [
                    "created_at" => "2021-06-22 11:27:02",
                    "detail" => "自动注入扩展字段",
                    "id" => 17,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:02",
                    "version" => "1.1.0"
                ],
                [
                    "created_at" => "2021-06-22 11:27:03",
                    "detail" => "移除了一些无用的配置",
                    "id" => 18,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:03",
                    "version" => "1.1.0"
                ],
                [
                    "created_at" => "2021-06-22 11:27:03",
                    "detail" => "增加详情页视频扩展字段",
                    "id" => 19,
                    "name" => "celaraze.dcat-extension-plus",
                    "type" => 1,
                    "updated_at" => "2021-06-22 11:27:03",
                    "version" => "1.1.1"
                ],
                [
                    "created_at" => "2021-06-22 12:08:51",
                    "detail" => "Initialize extension.",
                    "id" => 24,
                    "name" => "dcat-admin.files-manger",
                    "type" => 1,
                    "updated_at" => "2021-06-22 12:08:51",
                    "version" => "1.0.0"
                ],
                [
                    "created_at" => "2021-06-22 12:08:51",
                    "detail" => "样式部分优化",
                    "id" => 25,
                    "name" => "dcat-admin.files-manger",
                    "type" => 1,
                    "updated_at" => "2021-06-22 12:08:51",
                    "version" => "1.0.1"
                ]
            ]
		);

        // pivot tables
        DB::table('admin_permission_menu')->truncate();
		DB::table('admin_permission_menu')->insert(
			[

            ]
		);

        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [

            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [

            ]
        );

        // finish
    }
}
