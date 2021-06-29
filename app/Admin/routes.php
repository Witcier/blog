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
    $router->resource('navigation/categories', 'Navigation\CategoriesController');

    // 导航站网站地址管理
    $router->resource('navigation/sites', 'Navigation\SitesController');

    // 首页菜单配置
    $router->resource('nav', 'Nav\MenusController');

    // 配置管理
    $router->resource('config', 'Config\AdminConfigController');

    // 媒体管理
    $router->get('media', 'Media\MediaController@index')->name('media-index');

    $router->get('media/download', 'Media\MediaController@download')->name('media-download');

    $router->delete('media/delete', 'Media\MediaController@delete')->name('media-delete');

    $router->put('media/move',  'Media\MediaController@move')->name('media-move');

    $router->post('media/upload',  'Media\MediaController@upload')->name('media-upload');

    $router->post('media/folder',  'Media\MediaController@newFolder')->name('media-new-folder');

    // Wiki管理
    $router->resource('wiki', 'Wiki\ProjectsController');
    $router->group([
        'prefix' => 'wiki',
        'namespace' => 'Wiki'
    ], function (Router $router) {
        // Wiki 编辑页面
        $router->get('edit/{Project}', 'DocumentsController@edit')
            ->name('wiki.document.edit')
            ->where('id', '[0-9]+');
        // 文档保存
        $router->post('save/{wiki_project_id}', 'DocumentsController@save')
            ->name('wiki.document.save')
            ->where('wiki_project_id', '[0-9]+');
        // 新建文件、文件夹
        $router->post('edit/create/{wiki_project_id}', 'DocumentsController@create')
            ->name('wiki.document.create')
            ->where('wiki_project_id', '[0-9]+');;
        // 文档排序
        $router->post('sort/{wiki_project_id}', 'DocumentsController@sort')
            ->name('wiki.document.sort')
            ->where('wiki_project_id', '[0-9]+');
        // 文档重命名
        $router->post('rename/{wiki_project_id}/{doc_id}', 'DocumentsController@rename')
            ->name('wiki.document.rename')
            ->where('wiki_project_id', '[0-9]+')
            ->where('doc_id', '[0-9]+');
        // 文档删除
        $router->post('delete/{wiki_project_id}', 'DocumentsController@delete')
            ->name('wiki.document.delete')
            ->where('wiki_project_id', '[0-9]+');
        // 图片附件上传
        $router->post('upload/img', 'AssetUploadController@uploadImg')
            ->name('wiki.document.upload.img');
        // 文件附件上传
        $router->post('upload/file', 'AssetUploadController@uploadFile')
            ->name('wiki.document.upload.file');
    });

    // 思维导图
    $router->resource('xmind/categories', 'Xmind\CategoriesController');

});
