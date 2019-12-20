<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * The home controller.
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        $this->middleware('https');
        $this->middleware('auth');
        $this->middleware('impersonate');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable Show the dashboard.
     */
    public function index()
    {
        return view('home');
    }
}
