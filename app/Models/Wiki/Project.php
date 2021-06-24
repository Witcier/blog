<?php

namespace App\Models\Wiki;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'wiki_projects';

    const TYPE_PRIVATE = 0;
    const TYPE_PUBLIC = 1;
    
    public static $typeMap = [
        self::TYPE_PRIVATE => '私密',
        self::TYPE_PUBLIC => '公开',
    ];

    /**
    * 获取项目的文档树
    * @param int id
    * @return array
    */
    public static function getProjectArrayTree($id)
    {
        if (empty($id)) {
            return [];
        }
        $tree = WikiDocument::where('project_id', '=', $id)
            ->select(['id', 'name', 'type', 'parent_id'])
            ->orderBy('doc_sort', 'ASC')
            ->get();

        $jsonArray = [];
        if (empty($tree) === false) {
            foreach ($tree as &$item) {
                $tmp['id'] = $item->id. '';
                $tmp['text'] = $item->name;
                $tmp['parent'] = ($item->parent_id == 0 ? '#' : $item->parent_id) . '';

                $jsonArray[] = $tmp;
            }
        }
        return $jsonArray;
    }
}
