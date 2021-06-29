<?php

namespace App\Admin\Controllers\Xmind;

use App\Models\Xmind\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Tree;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Http\Controllers\AdminController;

class CategoriesController extends AdminController
{
    protected $title = '思维导图分类';

    /**
     * 展示所有分类
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {

        return $content->header('思维导图分类管理')
            ->description(trans('admin.list'))
            ->body($this->treeView());
    }

    protected function treeView()
    {
        return new Tree(new Category(), function (Tree $tree) {
            $tree->disableCreateButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Category(), function (Form $form) {
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
        });
    }
}
