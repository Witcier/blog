<?php

namespace App\Http\Controllers;

use App\Models\Nav\Menu;
class HomeController extends Controller
{
    public function index()
    {
        return view('welcome.index')
            ->with('menus', Menu::getMenu());
    }
}
