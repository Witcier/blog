<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\ModelTree;

class NavigationCategory extends Model
{
    use HasFactory, ModelTree;
    
    /**
     * 定义有多个子Category
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(NavigationCategory::class, 'parent_id');
    }

    /**
     * 定义一对多关系，一个分类下有多个地址索引
     */
    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
