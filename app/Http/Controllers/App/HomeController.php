<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a home view.
     *
     * @return \Illuminate\Contracts\Support\Renderable|string
     */
    public function index()
    {
        return view('app.home.index');
    }
}
