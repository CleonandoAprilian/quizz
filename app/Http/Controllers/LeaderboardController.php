<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
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
     * Show the leaderboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.leaderboard');
    }
}