<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\LiveScore;

class ScoringController extends Controller
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
     * Show the raw scoring from the NFL feed.
     *
     */
    public function updatescoring()
    {

        $url = env("NFL_URL", "http://www.nfl.com/liveupdate/scorestrip/ss.json");
//        $url = 'http://football.app/nfl-data';

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
        $games = json_decode($output);

        return view('pages.update-scores')->with([
            'games' => $games
            ]);
    }

    /**
     * Show the raw scoring from the NFL feed.
     *
     */
    public function updateGameDetails()
    {
        /**
        [ ] DWE TODO: Read current scoring detail from NFL feed
            [ ] 
        **/
        $url = env("NFL_URL", "http://www.nfl.com/liveupdate/scorestrip/ss.json");
//        $url = 'http://football.app/nfl-data';

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
        $games = json_decode($output);

        return view('pages.update-gamedetails')->with([
            'games' => $games
            ]);
    }
}
