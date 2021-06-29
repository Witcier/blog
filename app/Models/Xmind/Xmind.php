<?php

namespace App\Models\Xmind;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xmind extends Model
{
    use HasFactory;

    protected $table = 'xmind_map';
    
    const TYPE_PRIVATE = 0;
    const TYPE_PUBLIC = 1;

    public static $typeMap = [
        self::TYPE_PRIVATE => '私密',
        self::TYPE_PUBLIC => '公开',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'xmind_category_id');
    }
}
