<?php

namespace App\Http\Controllers;

use App\Models\Nav\Menu;
class HomeController extends Controller
{
    public function index()
    {
        return view('welcome.index' ,[
           'menus' => Menu::all()->sortBy('order'),
        ]);
    }
}
