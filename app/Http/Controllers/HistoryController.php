<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
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
     * Show the history page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.history');
    }
}