<?php

namespace App\Models\Navigation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $table = 'navigation_sites';

    public function category()
    {
        return $this->belongsTo(Category::class, 'navigation_category_id');
    }
}
