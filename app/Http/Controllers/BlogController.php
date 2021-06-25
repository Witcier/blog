<?php

namespace App\Http\Controllers;

use App\Http\ErrorDesc;
use App\Model\Admin\HomeNavMenu;
use App\Models\Nav\Menu;
use App\Models\Wiki\Document;
use App\Models\Wiki\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 博客站
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends BaseController
{
    /**
     * @var int 分页，每页的数量
     */
    private const PAGE_SIZE = 20;

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = 1;
        $documents = Document::getDocumentOrCategory(Document::TYPE_FILE)
            ->orderBy('created_at', "DESC")
            ->offset(($page - 1) * self::PAGE_SIZE)
            ->limit(self::PAGE_SIZE)
            ->get();

        if (empty($documents)) {
            abort(404);
        }

        // 获取项目详情，id、name、count
        $project = Project::query()
            ->where('type', Project::TYPE_PUBLIC)
            ->whereHas('documents', function ($query) {
                $query->where('type', Document::TYPE_FILE);
            })
            ->get();

        // 计算所有文章数量
        $documentCount = 0;
        foreach ($project as $item) {
            $documentCount += $item->count;
        }
        // 计算分页数量
        $pageCount = ceil($documentCount / self::PAGE_SIZE);

        return view('blog.index')
            ->with('navMenu', Menu::getMenu())
            ->with('blogArticle', $documents)
            ->with('blogCount', $documentCount)
            ->with('categoryCount', sizeof($project))
            ->with('pageCount', $pageCount)
            ->with('category', $project);
    }

    /**
     * 获取指定页的数据
     * @param int $page 页码
     * @return \Illuminate\Http\Response
     */
    public function getPageList($page)
    {
        $documents = Document::getDocumentOrCategory(Document::TYPE_FILE)
            ->orderBy('created_at', "DESC")
            ->offset(($page - 1) * self::PAGE_SIZE)
            ->limit(self::PAGE_SIZE)
            ->get();

        if (empty($documents)) {
            abort(404);
        }

        return $this->buildResponse(ErrorDesc::SUCCESS, $documents);
    }

    /**
     * 获取指定文章的详情页
     * @param $doc_id
     * @param String $title 文章标题
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getArticleDetail($doc_id, $title)
    {
        $doc = Document::where('name', '=', $title)
            ->where('id', '=', $doc_id)
            ->first();
        if (empty($doc)) {
            abort(404);
        }
        $project = Project::where('id', '=', $doc->project_id)->first();
        if (empty($project) || $project->type == Project::TYPE_PRIVATE) {
            abort(403);
        }
        return view('blog.detail.index')
            ->with('article', $doc);
    }
}
