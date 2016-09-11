<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Game;

class HomeController extends Controller
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
        $game = new Game();
        $standings = $game->getStandings();
        return view('pages.home')->with([
            'user' => $user,
            'standings' => $standings
        ]);

    }
    public function welcome() {
        if (Auth::check()) {
            return redirect('home');
        } else {
            return redirect('/');
        }
    }

}
