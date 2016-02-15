<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['loadView']]);
    }

    /**
     * Load the landing page, else if auhenticated load dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadView()
    {
        return view('layouts.dashboardhtml');
    }

    /**
     * Display the dashboard default page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('dashboard.index');
    }
}
