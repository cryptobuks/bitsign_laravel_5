<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Load dashboard.
     *
     * @return Response
     */
	public function showDash()
	{
		return view('layouts.dashboard');
	}

	/**
     * Return dashboard index.
     *
     * @return response
     */
	public function index()
	{
		return view('dashboard.index');
	}
}
