<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * shows user dashboard
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('blogs.dashboard.index');
    }
}
