<?php

namespace App\Models\Xmind;

use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, ModelTree;

    protected $table = 'xmind_categories';

    /**
     * 定义一对多关系，一个分类下有多个地址索引
     */
    public function xminds()
    {
        return $this->hasMany(XMind::class, 'xmind_category_id');
    }
}
