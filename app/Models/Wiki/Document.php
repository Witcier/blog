<?php

namespace App\Models\Wiki;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'wiki_documents';

    const TYPE_FILE = 0;
    const TYPE_DIR = 1;

    /**
     * 获取项目的文档目录结构
     * @param integer $projectId 项目Id
     * @return array 目录结构数组
     */
    public static function getDocumentCatalog($projectId)
    {
        if (empty($projectId)) {
            return [];
        }

        $tree = static::where('wiki_project_id', '=', $projectId)
            ->select('id', 'name', 'type', 'parent_id')
            ->orderBy('sort', 'ASC')
            ->get();
        $catalog = [];

        if (!empty($tree)) {
            foreach ($tree as $item) {
                $temp['id'] = $item->id . '';
                $temp['name'] = $item->name;
                $temp['type'] = $item->type . '';
                $temp['parentId'] = $item->parent_id;
                $temp['isParent'] = $item->type == self::TYPE_DIR;

                $catalog[] = $temp;
            }
        }
        return $catalog;
    }
}
