<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use DB;

class PagesController extends Controller
{
    public function home() {
    	return 'pooness';
    }

    public function rules() {
    	return view('pages.rules');
    }

    public function nflSeason() {

		$games = DB::table('games')
				->select('week_id', 'day_of_week', 'game_datetime', 'visitor_team', 'home_team', 'winner', 'visitor_score', 'home_score')
				->orderBy('id')
				->get();
    	return view('pages.nfl-season')->with([
            'games'=> $games
           ]);
    }
}
