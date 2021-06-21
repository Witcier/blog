<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    use HasFactory;

    /**
     * @var int 当前窗口打开
     */
    const TYPE_TARGET_SELF = 0;
    /**
     * @var int 新窗口打开
     */
    const TYPE_TARGET_BLANK = 1;

    /**
     * 获取菜单
     * @return HomeNavMenu[]|\Illuminate\Database\Eloquent\Collection
     */
    static function getNavMenu()
    {
        return HomeNavMenu::all()
            ->sortBy('order');
    }
}
