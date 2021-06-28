<?php

namespace App\Models\Xmind;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xmind extends Model
{
    use HasFactory;

    const TYPE_PRIVATE = 0;
    const TYPE_PUBLIC = 1;

    protected $table = 'xmind_map';

    public function category()
    {
        return $this->belongsTo(Category::class, 'xmind_category_id');
    }
}
