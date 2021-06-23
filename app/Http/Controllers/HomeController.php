<?php

namespace App\Http\Controllers;

use App\Models\NavMenu;
class HomeController extends Controller
{
    public function index()
    {
        return view('welcome.index')
            ->with('navMenu', NavMenu::all()->sortBy('order'));
    }
}
