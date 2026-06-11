<?php

namespace App\Http\Controllers;

use App\Services\FrontendContentService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(FrontendContentService $content): View
    {
        return view('pages.home', $content->home());
    }
}
