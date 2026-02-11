<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function home()
    {
        return view('site.pages.home.index');
    }
}
