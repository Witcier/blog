<?php

namespace App\Http\Controllers;

use App\Models\Nav\Menu;
use App\Models\Navigation\Category;
use App\Util\StatisticUtil;
/**
 * 网址收藏
 * Class NavigationController
 * @package App\Http\Controllers
 */
class NavigationController extends Controller
{
    public function index()
    {
        $categories = Category::with(
            ['children' => function ($query) {
                $query->orderBy('order');
            }, 'sites' => function ($query) {
                $query->orderBy('order');
            }])
            ->withCount('children')
            ->orderBy('order')
            ->get();

        return view('navigation.index')
            ->with('categories', $categories)
            ->with('navMenu', Menu::all()->sortBy('order'));
    }
}
