<?php

namespace App\Admin\Controllers\Navigation;

use App\Models\Navigation\Category;
use App\Models\Navigation\Site;
use Dcat\Admin\Http\Controllers\HasResourceActions;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SitesController extends AdminController
{
    use HasResourceActions;

    protected $title = '网站';

    /**
     * 网站列表展示
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Site());

        $grid->model()->with(['category']);
        $grid->column('category.title', '分类');
        $grid->column('title', '标题');
        $grid->describe('描述')->limit(40);
        $grid->url('地址');

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();

            $categories = Category::all()->pluck('title', 'id');
            $filter->equal('navigation_category_id', '分类')->select($categories);

            $filter->like('title', '标题');
        });
        
        $grid->showToolbar();
        $grid->toolsWithOutline(false);
        $grid->disableViewButton();

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Site());

        $form->select('navigation_category_id', '分类')
            ->options(Category::selectOptions())
            ->rules('required');
        $form->text('title', '标题')
            ->attribute('autocomplete', 'off')
            ->rules('required|max:50');
        $form->text('order', '顺序')
            ->default(10000)
            ->attribute('min', 1)
            ->attribute('max', 10000);
        $form->text('describe', '描述')
            ->attribute('autocomplete', 'off')
            ->rules('required|max:300');
        $form->url('url', '地址')
            ->attribute('autocomplete', 'off')
            ->rules('required|max:250');

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
