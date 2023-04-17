<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show home page
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return view('home');
    }
}
