<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // [HttpGet, route('home')]
    public function home()
    {
        return view('welcome');
    }
}
