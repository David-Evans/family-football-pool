<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Auth;

use App\Game;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $users = DB::table('users')->orderBy('nickname')->get();
        $game = new Game();
        $week = $game->getCurrentWeek();
        $picks = $game->showMissingPicks($week);

        return view('admin.index')->with([
            'user' => $user,
            'users' => $users,
            'picks' => $picks
        ]);

    }
}
