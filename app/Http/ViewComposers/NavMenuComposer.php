<?php
namespace App\Http\ViewComposers;

use App\Models\Nav\Menu;
use Illuminate\View\View;

class NavMenuComposer
{
    // 当渲染指定的模板时，Laravel 会调用 compose 方法
    public function compose(View $view)
    {
        // 使用 with 方法注入变量
        $view->with('navMenu',  Menu::getMenu());
    }
}