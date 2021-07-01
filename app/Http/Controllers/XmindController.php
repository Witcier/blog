<?php

namespace App\Http\Controllers;

use App\Http\ErrorDesc;
use App\Models\Xmind\Category;
use App\Models\Xmind\Xmind;
use Dcat\Admin\Admin;

/**
 * 思维导图相关控制器
 * Class XMindController
 * @package App\Http\Controllers
 */
class XmindController extends BaseController
{

    /**
     * 首页数据
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $project = null;

        if (Admin::user() != null && Admin::user()->isAdministrator()) {
            // 登录账户显示所有文档，包含隐私文档
            $project = Category::with(
                ['xminds' => function ($query) {
                    $query->select('id', 'name', 'type', 'xmind_category_id', 'order')
                        ->orderBy('order');
                }])
                ->orderBy('order')
                ->get();
        } else {
            $project = Category::with(
                ['xminds' => function ($query) {
                    $query->select('id', 'name', 'type', 'xmind_category_id', 'order')
                        ->where('type', '=', Xmind::TYPE_PUBLIC)
                        ->orderBy('order');
                }])
                ->orderBy('order')
                ->get();
        }

        $current = null;
        if (!empty($project)) {
            foreach ($project as $item) {
                foreach ($item->xminds as $xmind) {
                    if (!empty($xmind)) {
                        $current = Xmind::where('id', $xmind->id)->first();
                        break 2;
                    }
                }
            }
        }

        return view('xmind.index')
            ->with('projects', $project)
            ->with('current', $current);
    }

    /**
     * 获取指定文档内容
     * @param $name string 思维导图名称
     * @return \Illuminate\Http\Response
     */
    public function getContent($name)
    {
        if (empty($name)) {
            abort(404);
        }
        $project = Xmind::where('name', '=', $name)->first();
        if (empty($project)) {
            abort(404);
        }
        if ($project->type == Xmind::TYPE_PRIVATE && (Admin::user() == null || !Admin::user()->isAdministrator())) {
            abort(403);
        }
        $data['content'] = $project->content != null ? $project->content : "";
        return $this->buildResponse(ErrorDesc::SUCCESS, $data);
    }
}
