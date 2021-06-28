<?php

namespace App\Http\Controllers;

use App\Models\Nav\Menu;

/**
 * 留言板
 * Class GuestBookController
 * @package App\Http\Controllers
 */
class GuestBookController extends BaseController
{
    /**
     * 首页
     */
    public function index()
    {
        return view('guestbook.index');
    }
}
