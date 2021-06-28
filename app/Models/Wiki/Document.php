<?php

namespace App\Models\Wiki;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'wiki_documents';

    protected $appends = [
        'date', 'category_name', 'title', 'link'
    ];

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

    public static function getDocumentOrCategory($type)
    {
        return static::query()
            ->where('type', $type)
            ->whereHas('project', function ($query) {
                $query->where('type', Project::TYPE_PUBLIC);
            });
    }

    public static function countDocument()
    {
        return static::where('type', self::TYPE_FILE)
            ->count();
    }

    public function getDateAttribute()
    {
        return $this->updated_at->format('Y-m-d');
    }

    public function getCategoryNameAttribute()
    {
        return $this->project->name;
    }

    public function getTitleAttribute()
    {
        return $this->parent ? $this->parent->name . " ➞ " . $this->name : $this->name;
    }

    public function getLinkAttribute()
    {
        return route('blog.article.detail',['document' => $this->id]);
    }

    public function getCountAttribute()
    {
        return static::where('type', static::TYPE_FILE)
            ->where('parent_id', $this->id)
            ->count();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'wiki_project_id');
    }

    public function parent()
    {
        return $this->belongsTo(Document::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Document::class, 'parent_id');
    }
}
