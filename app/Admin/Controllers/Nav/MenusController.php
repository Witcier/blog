<?php

namespace App\Admin\Controllers\Nav;

use App\Models\Nav\Menu;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class MenusController extends AdminController
{
    protected $title = '首页菜单';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Menu(), function (Grid $grid) {
            $grid->model()->orderBy('order','asc');
            
            $grid->name('菜单名称');
            $grid->path('路由路径');
            $grid->order('顺序')->sortable();
            $grid->target('打开方式')->using([
                '0' => '原窗口',
                '1' => '新窗口',
            ])->label([
                0 => 'danger',
                1 => 'default',
            ]);
            $grid->created_at('创建时间')->date('Y-m-d');

            $grid->disableFilter();
            $grid->toolsWithOutline(false);
            $grid->disableColumnSelector();
    
            $grid->actions(function ($actions) {
                // 去掉查看
                $actions->disableView();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Menu(), function (Form $form) {
            $form->text('name', "菜单名称")->required();
            $form->text('path', '路由路径')->required();
            $form->radio('target', '打开方式')
                ->options([Menu::TYPE_TARGET_SELF => '原窗口', Menu::TYPE_TARGET_BLANK => '新窗口'])
                ->default(Menu::TYPE_TARGET_SELF)
                ->required();
            $form->number('order', "显示顺序")
                ->default(1)
                ->min(0)
                ->max(100)
                ->required();
    
            $form->footer(function ($footer) {
                // 去掉`查看`checkbox
                $footer->disableViewCheck();
    
                // 去掉`继续编辑`checkbox
                $footer->disableEditingCheck();
    
                // 去掉`继续创建`checkbox
                $footer->disableCreatingCheck();
            });
            return $form;
        });
    }
}
