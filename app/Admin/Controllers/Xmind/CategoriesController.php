<?php

namespace App\Admin\Controllers\Xmind;

use App\Models\Xmind\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Show;
use Dcat\Admin\Tree;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Http\Controllers\AdminController;

class CategoriesController extends AdminController
{
    /**
     * 展示所有分类
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {

        return $content->header('分类管理')
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
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new XmindCategory(), function (Show $show) {
            $show->field('id');
            $show->field('icon');
            $show->field('order');
            $show->field('parent_id');
            $show->field('title');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new XmindCategory(), function (Form $form) {
            $form->display('id');
            $form->text('icon');
            $form->text('order');
            $form->text('parent_id');
            $form->text('title');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
