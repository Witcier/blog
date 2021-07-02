<?php

namespace App\Admin\Controllers\Xmind;

use App\Http\ErrorDesc;
use App\Models\Xmind\Category;
use App\Models\Xmind\Xmind;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;

class XmindController extends AdminController
{
    protected $title = '思维导图';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Xmind(), function (Grid $grid) {
            $grid->model()->with(['category']);

            $grid->name('名称');
            $grid->column('category.title', '分类');
            $grid->type('类型')->display(function ($value) {
                return Xmind::$typeMap[$value];
            })->label([
                0 => 'danger',
                1 => 'success',
            ]);
            $grid->order('顺序');
            $grid->created_at('创建时间')->date('Y-m-d');
            $grid->updated_at('修改时间')->date('Y-m-d');
    
            $grid->actions(function ($actions) {
    
                $href = "/admin/xmind/detail/" . $actions->row->id;
                $actions->append("<a href=$href target='_blank'><i class='fa fa-paper-plane'></i></a>");
    
                // 去掉查看
                $actions->disableView();
            });
    
            $grid->toolsWithOutline(false);
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
        return Form::make(new Xmind(), function (Form $form) {
            $form->text('name', "名称")->required();

            $form->select('xmind_category_id', '分类')
            ->options(Category::selectOptions())
            ->rules('required|regex:/^[1-9][0-9]*$/', [
                'regex' => '请选择导图分类，如果没有请先新建'
            ]);
    
            $form->text('order', '顺序')
                ->default(10000)
                ->attribute('min', 1)
                ->attribute('max', 10000);

            $form->radio('type', "类型")
                ->options([XMind::TYPE_PUBLIC => '公开', XMind::TYPE_PRIVATE => '私密'])
                ->default(XMind::TYPE_PUBLIC)
                ->required();
    
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

    /**
     * 编辑具体的思维导图
     * @param int $id id
     * @return View
     */
    public function editXMind(Xmind $xmind)
    {
        return view('admin.xmind.edit.index')
            ->with("notUseCommonCss", true)
            ->with("project", $xmind);
    }

    /**
     * 保存变动
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function save(Xmind $xmind, Request $request)
    {
        if (!$data = $request->getContent()) {
            return $this->buildResponse(ErrorDesc::REQUEST_BODY_EMPTY);
        }

        $data = json_decode($data);

        $result = $xmind->update([
            'content' => $data->content,
        ]);

        if ($result) {
            return $this->buildResponse(ErrorDesc::SUCCESS);
        } else {
            return $this->buildResponse(ErrorDesc::DB_ERROR);
        }
    }

    protected function buildResponse($errorDesc, $data = null)
    {
        $content = ['errCode' => $errorDesc[0], 'msg' => $errorDesc[1]];
        if (!empty($data)) {
            $content['data'] = $data;
        }

        return response()->json($content);
    }
}
