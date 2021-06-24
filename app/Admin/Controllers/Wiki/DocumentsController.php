<?php

namespace App\Admin\Controllers\Wiki;

use App\Http\Controllers\BaseController;
use App\Http\ErrorDesc;
use App\Models\Wiki\Document;
use App\Models\Wiki\Project;
use Illuminate\Http\Request;

class DocumentsController extends BaseController
{
    /**
     * 编辑文档
     * @param int $id ProjectId
     * @return View
     */
    public function edit(Project $Project)
    {
        if (empty($Project)) {
            abort(404);
        }
        $this->data['wiki_project'] = $Project;

        $catalog = Document::getDocumentCatalog($Project->id);
        $this->data['doc_catalog'] = json_encode($catalog, JSON_UNESCAPED_UNICODE);

        $this->data['wiki_project_id'] = $Project->id;

        return view('admin.wiki.edit.index', $this->data);
    }

    /**
     * 保存文档
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request,$projectId)
    {
        if ($request->isMethod('post')) {
            $data = $this->request->all();
            if (empty($data)) {
                return $this->buildResponse(ErrorDesc::REQUEST_BODY_EMPTY);
            }

            if (empty(Project::find($projectId))) {
                return $this->buildResponse(ErrorDesc::WIKI_PROJECT_NOT_EXIST);
            }
            $content = $this->request->input('editormd-markdown-doc', null);
            $docId = $this->request->input('doc_id', '');
            $result = Document::where('wiki_project_id', '=', $projectId)
                ->where('id', '=', $docId)
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
     * 创建文件夹、文档
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function create($projectId, Request $request)
    {
        if ($request->isMethod('post')) {
            $parentId = $request->input('parent_id', 0);
            $parentTId = $request->input('parent_t_id', '');
            $name = $request->input('name', '');
            $type = $request->input('type', 0);

            if (empty($name)) {
                return $this->buildResponse(ErrorDesc::WIKI_NAME_EMPTY);
            }
            // 父级目录不是根目录，要判断父级目录是否存在
            if (strcmp('0', $parentId) != 0) {
                $parentDoc = Document::where('wiki_project_id', '=', $projectId)
                    ->where('id', '=', $parentId)
                    ->first();
                if (empty($parentDoc)) {
                    return $this->buildResponse(ErrorDesc::WIKI_PARENT_DOC_EMPTY);
                }
            }
            $document = new Document();
            $document->wiki_project_id = $projectId;
            $document->name = $name;
            $document->type = $type;
            $document->parent_id = $parentId;
            $maxSort = Document::where('parent_id', '=', $parentId)
                ->orderBy('sort', 'DESC')
                ->first();
            $document->sort = ($maxSort ? $maxSort['sort'] + 1 : 0);

            // 开启事务
            \DB::beginTransaction();
            if (!$document->save()) {
                \DB::rollback();
                return $this->buildResponse(ErrorDesc::DB_ERROR);
            }
            // 更新 Project 内文档数目信息
            if ($type == Document::TYPE_FILE) {
                $docCount = Document::where('wiki_project_id', '=', $projectId)
                    ->where('type', '=', Document::TYPE_FILE)
                    ->count();
                $result = Project::where('id', '=', $projectId)
                    ->update(['doc_count' => $docCount]);
                if (!$result) {
                    \DB::rollback();
                    return $this->buildResponse(ErrorDesc::DB_ERROR);
                }
            }
            \DB::commit();

            // 构造要返回的节点数据，key 值不能变，符合 Ztree 数据格式
            $data['id'] = $document->id . '';
            $data['name'] = $document->name;
            $data['type'] = $document->type . '';
            $data['parentId'] = $document->parent_id;
            $data['parentTId'] = $parentTId;
            $data['isParent'] = strcmp($document->type, Document::TYPE_DIR) == 0;

            return $this->buildResponse(ErrorDesc::SUCCESS, $data);
        }
        return $this->buildResponse(ErrorDesc::METHOD_NOT_ALLOWED);
    }

    /**
     * 目录排序
     * @param integer $projectId 项目Id
     * @return \Illuminate\Http\Response
     */
    public function sort($projectId)
    {
        $data = $this->request->getContent();
        if (empty($data)) {
            return $this->buildResponse(ErrorDesc::REQUEST_BODY_EMPTY);
        }
        $data = json_decode($data);

        if (empty(Project::find($projectId))) {
            return $this->buildResponse(ErrorDesc::WIKI_PROJECT_NOT_EXIST);
        }

        \DB::transaction(function () use ($projectId, $data) {
            // 更新parent_id
            $document = ['parent_id' => $data->parentId];
            Document::where('id', '=', $data->id)
                ->where('wiki_project_id', '=', $projectId)
                ->update($document);
            // 更新顺序
            $sibling = $data->sibling;
            foreach ($sibling as $item) {
                $data = ['sort' => $item->sort];
                Document::where('id', '=', $item->id)
                    ->where('wiki_project_id', '=', $projectId)
                    ->where('parent_id', '=', $item->parentId)
                    ->update($data);
            }
        });
        return $this->buildResponse(ErrorDesc::SUCCESS);
    }

    /**
     * 文档重命名
     * @param integer $projectId 项目Id
     * @param integer $docId 文档Id
     * @return \Illuminate\Http\Response
     */
    public function rename($projectId, $docId)
    {
        $data = $this->request->getContent();
        if (empty($data)) {
            return $this->buildResponse(ErrorDesc::REQUEST_BODY_EMPTY);
        }
        $data = json_decode($data);

        if (empty(Project::find($projectId))) {
            return $this->buildResponse(ErrorDesc::WIKI_PROJECT_NOT_EXIST);
        }

        Document::where('wiki_project_id', '=', $projectId)
            ->where('id', '=', $docId)
            ->update(['name' => $data->newName]);
        return $this->buildResponse(ErrorDesc::SUCCESS);
    }

    /**
     * 删除文档
     * @param $projectId
     * @return \Illuminate\Http\Response
     */
    public function delete($projectId)
    {
        $data = $this->request->getContent();
        if (empty($data)) {
            return $this->buildResponse(ErrorDesc::REQUEST_BODY_EMPTY);
        }
        $data = json_decode($data);

        if (empty(Project::find($projectId))) {
            return $this->buildResponse(ErrorDesc::WIKI_PROJECT_NOT_EXIST);
        }
        // 开启事务
        \DB::beginTransaction();
        $result = Document::where('wiki_project_id', '=', $projectId)
            ->whereIn('id', $data)
            ->delete();
        if (!$result) {
            \DB::rollBack();
            return $this->buildResponse(ErrorDesc::DB_ERROR);
        }
        // 更新文档数目
        $docCount = Document::where('wiki_project_id', '=', $projectId)
            ->where('type', '=', Document::TYPE_FILE)
            ->count();
        $result = Project::where('id', '=', $projectId)
            ->update(['doc_count' => $docCount]);
        if (!$result) {
            \DB::rollback();
            return $this->buildResponse(ErrorDesc::DB_ERROR);
        }
        \DB::commit();

        return $this->buildResponse(ErrorDesc::SUCCESS);
    }
}
