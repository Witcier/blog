<?php

namespace App\Http\Controllers;

use App\Http\ErrorDesc;
use App\Models\Nav\Menu;
use App\Models\Wiki\Document;
use App\Models\Wiki\Project;
use Illuminate\Http\Request;

/**
 * 博客站
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends BaseController
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $documents = Document::getDocumentByPage();

        if (empty($documents)) {
            abort(404);
        }

        // 获取项目详情
        $projects = Project::query()
            ->where('type', Project::TYPE_PUBLIC)
            ->whereHas('documents', function ($query) {
                $query->where('type', Document::TYPE_FILE);
            })
            ->get();

        // 计算所有文章数量
        $documentCount = Document::countDocument();

        // 计算分页数量
        $pageCount = ceil($documentCount / Document::PAGE_SIZE);

        return view('blog.index')
            ->with('documents', $documents)
            ->with('documentCount', $documentCount)
            ->with('pageCount', $pageCount)
            ->with('projects', $projects);
    }

    /**
     * 获取指定页的数据
     * @param int $page 页码
     * @return \Illuminate\Http\Response
     */
    public function getPageList($page)
    {
        $documents = Document::getDocumentByPage($page);

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
    public function getArticleDetail(Document $document)
    {
        if (empty($document)) {
            abort(404);
        }
        if (empty($document->project) || $document->project->type == Project::TYPE_PRIVATE) {
            abort(403);
        }
        return view('blog.detail.index')
            ->with('article', $document);
    }
}
