<?php

namespace App\Models\Navigation;

use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, ModelTree;

    protected $table = 'navigation_categories';

    /**
     * 定义有多个子Category
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * 定义一对多关系，一个分类下有多个地址索引
     */
    public function sites()
    {
        return $this->hasMany(Site::class, 'navigation_category_id');
    }
}
