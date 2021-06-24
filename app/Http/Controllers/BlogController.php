<?php

namespace App\Http\Controllers;

use App\Http\ErrorDesc;
use App\Model\Admin\HomeNavMenu;
use App\Models\Wiki\Document;
use App\Models\Wiki\Project;
use Illuminate\Database\Eloquent\Collection;
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
    private const PAGE_SIZE = 30;

    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $document = $this->getBlogArticle(1, self::PAGE_SIZE);

        if (empty($document)) {
            abort(404);
        }

        // 获取项目详情，id、name、count
        $project = $this->getBlogProject();

        // 计算所有文章数量
        $documentCount = 0;
        foreach ($project as $item) {
            $documentCount += $item->count;
        }
        // 计算分页数量
        $pageCount = ceil($documentCount / self::PAGE_SIZE);

        return view('blog.index')
            ->with('navMenu', HomeNavMenu::getNavMenu())
            ->with('blogArticle', $document)
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
        $document = $this->getBlogArticle($page, self::PAGE_SIZE);
        if (empty($document)) {
            abort(404);
        }
        return $this->buildResponse(ErrorDesc::SUCCESS, $document);
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

    /**
     * 分页查询数据
     * @param int $page 当前页数
     * @param int $size 每页的数量
     * @return Collection 分页查询结果
     */
    private function getBlogArticle($page, $size)
    {
        $document = Document::where('wiki_document.type', '=', Document::TYPE_FILE)
            ->whereIn('wiki_document.project_id', function ($query) {
                $query->select('id')
                    ->from('wiki_project')
                    ->where('type', '=', Project::TYPE_PUBLIC)
                    ->where('sync_to_blog', '=', true);
            })
            ->leftJoin('wiki_document as B', 'wiki_document.parent_id', '=', 'B.id')
            ->join('wiki_project', 'wiki_project.id', '=', 'wiki_document.project_id')
            ->select('wiki_document.id as id', 'wiki_document.name as title', 'B.name as p_title', 'wiki_project.name as category', 'wiki_document.created_at')
            ->orderBy('created_at', "DESC")
            ->offset(($page - 1) * $size)
            ->limit($size)
            ->get();
        if (!empty($document)) {
            foreach ($document as &$item) {
                // 直接截取
                $item->date = substr($item->created_at, 0, 10);
                // 访问文章链接
                $item->link = "/blog/detail/$item->id/$item->title";
            }
            unset($item);
        }
        return $document;
    }

    /**
     * 所有项目详情，id、name、文章数量（公开且同步到博客类文档）
     */
    private function getBlogProject()
    {
        return Document::where('wiki_document.type', '=', Document::TYPE_FILE)
            ->whereIn('project_id', function ($query) {
                $query->select('id')
                    ->from('wiki_project')
                    ->where('type', '=', Project::TYPE_PUBLIC)
                    ->where('sync_to_blog', '=', true);
            })
            ->join('wiki_project', 'wiki_project.id', '=', 'wiki_document.project_id')
            ->select('wiki_project.id as id', 'wiki_project.name as name', DB::raw('count(*) as count'))
            ->groupBy('wiki_project.id', 'wiki_project.name')
            ->get();
    }
}
