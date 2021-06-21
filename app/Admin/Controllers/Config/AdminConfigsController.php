<?php

namespace App\Admin\Controllers\Config;

use App\Models\AdminConfig;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class AdminConfigsController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new AdminConfig(), function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name()->display(function ($name) {
                return "<a tabindex=\"0\" class=\"btn btn-xs btn-twitter\" role=\"button\" data-toggle=\"popover\" data-html=true title=\"Usage\" data-content=\"<code>config('$name');</code>\">$name</a>";
            });
            $grid->value();
            $grid->column('description');
    
            $grid->created_at()->date('Y-m-d');
            $grid->updated_at()->date('Y-m-d');
    
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
        return Form::make(new AdminConfig(), function (Form $form) {
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
