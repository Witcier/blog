<?php

namespace App\Http\Controllers;

use App\Models\Nav\Menu;
use App\Models\Visit\Visit;
/**
 * 关于 页面
 * Class AboutController
 * @package App\Http\Controllers
 */
class AboutController extends BaseController
{
    public function index()
    {
        return view('about.index')
            ->with('navMenu', Menu::getMenu())
            ->with('visits', Visit::all());
    }
}
