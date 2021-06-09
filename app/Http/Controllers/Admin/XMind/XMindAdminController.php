<?php

namespace App\Http\Controllers\Admin\XMind;

use App\Http\Controllers\BaseController;
use App\Http\ErrorDesc;
use App\Model\XMind\Category;
use App\Model\XMind\XMind;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\View\View;

/**
 * 思维导图后台管理控制器
 * Class XMindAdminController
 * @package App\Http\Controllers\Admin\XMind
 */
class XMindAdminController extends BaseController
{

    /**
     * 表单对象，包含新增、删除等操作
     */
    use ModelForm;

    /**
     * 首页，显示导图列表
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content->title("思维导图")
            ->body($this->xMindList());
    }

    /**
     * 创建新项目
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content->title("新建导图")
            ->body($this->form());
    }

    /**
     * 编辑项目
     * @param Content $content
     * @param $id
     * @return Content
     */
    public function edit(Content $content, $id)
    {
        return $content->header('编辑项目')
            ->body($this->form()->edit($id));
    }

    /**
     * 编辑具体的思维导图
     * @param int $id id
     * @return View
     */
    public function editXMind($id)
    {
        if (empty($id) || $id <= 0) {
            abort(404);
        }
        $mindProject = XMind::find($id);
        if (empty($mindProject)) {
            abort(404);
        }
        return view('admin.xmind.edit.index')
            ->with("notUseCommonCss", true)
            ->with("project", $mindProject);
    }

    /**
     * 保存变动
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function save($id)
    {
        if ($this->isPost()) {
            $data = $this->request->getContent();
            if (empty($data)) {
                return $this->buildResponse(ErrorDesc::REQUEST_BODY_EMPTY);
            }

            if (empty(XMind::find($id))) {
                return $this->buildResponse(ErrorDesc::MIND_PROJECT_NOT_EXIST);
            }

            $data = json_decode($data);
            $content = $data->content;
            $result = XMind::where('id', '=', $id)
                ->update(['content' => $content]);

            if ($result) {
                return $this->buildResponse(ErrorDesc::SUCCESS);
            } else {
                return $this->buildResponse(ErrorDesc::DB_ERROR);
            }
        }
        return $this->buildResponse(ErrorDesc::METHOD_NOT_ALLOWED);
    }

    /**
     * 思维导图列表
     */
    private function xMindList()
    {
        $grid = new Grid(new XMind());
        $grid->name('名称');
        $grid->category()->title('分类');
        $grid->type('类型')->display(function ($type) {
            switch ($type) {
                case XMind::$TYPE_PRIVATE:
                    return "<span class='label label-danger'>私密</span>";
                case XMind::$TYPE_PUBLIC:
                    return "<span class='label label-success'>公开</span>";
                default:
                    return "<span class='label label-default'>未知-非法</span>";
            }
        });
        $grid->order('顺序');
        $grid->created_at('创建时间')->date('Y-m-d');
        $grid->updated_at('修改时间')->date('Y-m-d');

        $grid->actions(function ($actions) {

            $href = "/admin/xmind/detail/edit/" . $actions->row->id;
            $actions->append("<a href=$href target='_blank'><i class='fa fa-paper-plane'></i></a>");

            // 去掉查看
            $actions->disableView();
        });

        $grid->disableFilter();
        $grid->disableRowSelector();
        $grid->disableExport();
        $grid->disableColumnSelector();
        return $grid;
    }

    /**
     * 创建项目的表单
     */
    private function form()
    {
        $form = new Form(new XMind());

        $form->text('name', "名称")->required();

        $form->radio('type', "类型")
            ->options([XMind::$TYPE_PUBLIC => '公开', XMind::$TYPE_PRIVATE => '私密'])
            ->default(XMind::$TYPE_PUBLIC)
            ->required();

        $form->text('order', '顺序')
            ->default(10000)
            ->attribute('min', 1)
            ->attribute('max', 10000);

        $form->select('category_id', '分类')
            ->options(Category::selectOptions())
            ->rules('required|regex:/^[1-9][0-9]*$/', [
                'regex' => '请选择导图分类，如果没有请先新建'
            ]);

        $form->footer(function ($footer) {
            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
