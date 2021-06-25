<?php

namespace App\Models\Nav;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'nav_menus';
    /**
     * @var int 当前窗口打开
     */
    const TYPE_TARGET_SELF = 0;
    /**
     * @var int 新窗口打开
     */
    const TYPE_TARGET_BLANK = 1;

    protected $fillable = [
        'name', 'path', 'order', 'target',
    ];

    public static function getMenu()
    {
        return static::all()->sortBy('order');
    }
}
