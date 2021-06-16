<?php

namespace App\Admin\Controllers\Navigation;

use App\Models\NavigationCategory;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Tree;
use Dcat\Admin\Http\Controllers\AdminController;

class NavigationCategoriesController extends AdminController
{
    protected $title = '导航-分类';

    public function index(Content $content)
    {
        return $content
            ->description(trans('admin.list'))
            ->body($this->treeView());
    }

    protected function treeView()
    {
        return new Tree(new NavigationCategory(), function (Tree $tree) {
            $tree->disableCreateButton();
        });
    }

    /**
     * 编辑分类
     * @param Content $content
     * @param $id 分类ID
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content->header('编辑分类')
            ->body($this->form()->edit($id));
    }

    /**
     * 创建表单
     * 参见：https://laravel-admin.org/docs/zh/model-form
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new NavigationCategory());

        $form->select('parent_id', '父级')
            ->options(NavigationCategory::selectOptions())
            ->rules('required');
        $form->text('title', '标题')
            ->rules('required|max:50')
            ->placeholder('不得超过50个字符');
        $form->icon('icon', '图标')
            ->default('fa-star-o')
            ->rules('required|max:20');

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
