<?php

namespace App\Admin\Controllers\Wiki;

use App\Models\WikiProject;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class WikiProjectsController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new WikiProject(), function (Grid $grid) {
            $grid->id('项目ID');
            $grid->name('项目名称');
            $grid->description('项目描述');
            $grid->doc_count('文档数量');
            $grid->type('类型')->display(function ($value) {
               return WikiProject::$typeMap[$value];
            })->label([
                0 => 'danger',
                1 => 'success',
            ]);
            $grid->sync_to_blog('同步到博客')->using([
                '0' => '不同步',
                '1' => '同步',
            ])->label([
                0 => 'danger',
                1 => 'success',
            ]);
            $grid->column('thumb')->image(config('filesystems.disks.admin.url'), 50, 50);
            $grid->created_at('创建时间')->date('Y-m-d');
            $grid->updated_at('修改时间')->date('Y-m-d');
    
            $grid->actions(function ($actions) {
                $href = "/admin/wiki/edit/" . $actions->row->id;
                $actions->append("<a href=$href target='_blank'><i class='fa fa-paper-plane'></i></a>");
    
                // 去掉查看
                $actions->disableView();
            });
    
            $grid->disableFilter();
            $grid->disableRowSelector();
            $grid->disableColumnSelector();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new WikiProject(), function (Form $form) {
            $form->text('name', "项目名称")->required();
            $form->textarea('description', "项目描述")->required();
            $form->radio('type', "类型")
                ->options([WikiProject::TYPE_PUBLIC => '公开', WikiProject::TYPE_PRIVATE => '私密'])
                ->default(WikiProject::TYPE_PUBLIC)
                ->required();
    
            $form->radio("sync_to_blog", "同步到博客")
                ->options([true => '同步', false => '不同步'])
                ->help("此选项只对公开项目有效")
                ->default(true)
                ->required();
    
            $form->image('thumb', '封面图')
                ->help('图片尺寸需要 300*200')
                ->autoUpload()
                ->uniqueName();
    
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
