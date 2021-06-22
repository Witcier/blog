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
                    "id" => 1,
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "Index",
                    "icon" => "feather icon-bar-chart-2",
                    "uri" => "/",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => NULL
                ],
                [
                    "id" => 2,
                    "parent_id" => 0,
                    "order" => 8,
                    "title" => "Admin",
                    "icon" => "feather icon-settings",
                    "uri" => "",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => "2021-06-18 14:53:51"
                ],
                [
                    "id" => 3,
                    "parent_id" => 2,
                    "order" => 9,
                    "title" => "Users",
                    "icon" => "",
                    "uri" => "auth/users",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => "2021-06-18 14:53:51"
                ],
                [
                    "id" => 4,
                    "parent_id" => 2,
                    "order" => 10,
                    "title" => "Roles",
                    "icon" => "",
                    "uri" => "auth/roles",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => "2021-06-18 14:53:51"
                ],
                [
                    "id" => 5,
                    "parent_id" => 2,
                    "order" => 11,
                    "title" => "Permission",
                    "icon" => "",
                    "uri" => "auth/permissions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => "2021-06-18 14:53:51"
                ],
                [
                    "id" => 6,
                    "parent_id" => 2,
                    "order" => 12,
                    "title" => "Menu",
                    "icon" => "",
                    "uri" => "auth/menu",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => "2021-06-18 14:53:51"
                ],
                [
                    "id" => 7,
                    "parent_id" => 2,
                    "order" => 13,
                    "title" => "Extensions",
                    "icon" => "",
                    "uri" => "auth/extensions",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => "2021-06-18 14:53:51"
                ],
                [
                    "id" => 8,
                    "parent_id" => 0,
                    "order" => 3,
                    "title" => "导航-分类",
                    "icon" => NULL,
                    "uri" => "navigation/categories",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-16 15:55:03",
                    "updated_at" => "2021-06-17 16:46:00"
                ],
                [
                    "id" => 9,
                    "parent_id" => 0,
                    "order" => 4,
                    "title" => "网站管理",
                    "icon" => NULL,
                    "uri" => "navigation/sites",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-16 17:18:59",
                    "updated_at" => "2021-06-17 16:46:00"
                ],
                [
                    "id" => 10,
                    "parent_id" => 0,
                    "order" => 5,
                    "title" => "Wiki管理",
                    "icon" => NULL,
                    "uri" => "wiki",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-17 09:22:44",
                    "updated_at" => "2021-06-17 16:46:00"
                ],
                [
                    "id" => 11,
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "首页菜单",
                    "icon" => NULL,
                    "uri" => "nav",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-17 16:45:51",
                    "updated_at" => "2021-06-17 16:46:00"
                ],
                [
                    "id" => 12,
                    "parent_id" => 0,
                    "order" => 6,
                    "title" => "配置管理",
                    "icon" => NULL,
                    "uri" => "config",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-17 17:17:09",
                    "updated_at" => "2021-06-17 17:17:17"
                ],
                [
                    "id" => 13,
                    "parent_id" => 0,
                    "order" => 7,
                    "title" => "媒体库",
                    "icon" => NULL,
                    "uri" => "media",
                    "extension" => "",
                    "show" => 1,
                    "created_at" => "2021-06-18 14:53:44",
                    "updated_at" => "2021-06-18 14:54:26"
                ]
            ]
        );

        Models\Permission::truncate();
        Models\Permission::insert(
            [
                [
                    "id" => 1,
                    "name" => "Auth management",
                    "slug" => "auth-management",
                    "http_method" => "",
                    "http_path" => "",
                    "order" => 1,
                    "parent_id" => 0,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => NULL
                ],
                [
                    "id" => 2,
                    "name" => "Users",
                    "slug" => "users",
                    "http_method" => "",
                    "http_path" => "/auth/users*",
                    "order" => 2,
                    "parent_id" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => NULL
                ],
                [
                    "id" => 3,
                    "name" => "Roles",
                    "slug" => "roles",
                    "http_method" => "",
                    "http_path" => "/auth/roles*",
                    "order" => 3,
                    "parent_id" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => NULL
                ],
                [
                    "id" => 4,
                    "name" => "Permissions",
                    "slug" => "permissions",
                    "http_method" => "",
                    "http_path" => "/auth/permissions*",
                    "order" => 4,
                    "parent_id" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => NULL
                ],
                [
                    "id" => 5,
                    "name" => "Menu",
                    "slug" => "menu",
                    "http_method" => "",
                    "http_path" => "/auth/menu*",
                    "order" => 5,
                    "parent_id" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => NULL
                ],
                [
                    "id" => 6,
                    "name" => "Extension",
                    "slug" => "extension",
                    "http_method" => "",
                    "http_path" => "/auth/extensions*",
                    "order" => 6,
                    "parent_id" => 1,
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => NULL
                ]
            ]
        );

        Models\Role::truncate();
        Models\Role::insert(
            [
                [
                    "id" => 1,
                    "name" => "Administrator",
                    "slug" => "administrator",
                    "created_at" => "2021-06-15 10:04:17",
                    "updated_at" => "2021-06-15 10:04:18"
                ]
            ]
        );

        Models\Setting::truncate();
		Models\Setting::insert(
			[

            ]
		);

		Models\Extension::truncate();
		Models\Extension::insert(
			[

            ]
		);

		Models\ExtensionHistory::truncate();
		Models\ExtensionHistory::insert(
			[

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
