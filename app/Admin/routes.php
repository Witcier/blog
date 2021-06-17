<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    // 仪表盘
    $router->get('/', 'HomeController@index')->name('admin:dashboard');

    // 导航站分类管理
    $router->resource('navigation/categories', 'Navigation\NavigationCategoriesController');

    // 导航站网站地址管理
    $router->resource('navigation/sites', 'Navigation\NavigationSitesController');

});
