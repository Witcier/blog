<?php

namespace App\Admin\Controllers\Config;

use App\Models\Admin\Config;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class AdminConfigController extends AdminController
{
    protected $title = '配置管理';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Config(), function (Grid $grid) {
            $grid->name()->display(function ($name) {
                return "<a tabindex=\"0\" class=\"btn btn-xs btn-twitter\" role=\"button\" data-toggle=\"popover\" data-html=true title=\"Usage\" data-content=\"<code>config('$name');</code>\">$name</a>";
            });
            $grid->value()->width('1200px');
            $grid->column('description');
    
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('name');
                $filter->like('value');
            });

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
        return Form::make(new Config(), function (Form $form) {
            $form->display('id', 'ID');
            $form->text('name')->rules('required');
            $form->textarea('value')->rules('required');
            $form->textarea('description')->rules('required');
    
            $form->display('created_at');
            $form->display('updated_at');

            $form->footer(function ($footer) {
                // 去掉`查看`checkbox
                $footer->disableViewCheck();
    
                // 去掉`继续编辑`checkbox
                $footer->disableEditingCheck();
    
                // 去掉`继续创建`checkbox
                $footer->disableCreatingCheck();
            });
        });
    }
}
