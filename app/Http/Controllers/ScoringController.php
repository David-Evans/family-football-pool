<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\LiveScore;

use DB;

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
        date_default_timezone_set('America/New_York');
        $url = env("NFL_URL", "http://www.nfl.com/liveupdate/scorestrip/ss.json");
//        $url = 'http://football.app/nfl-data';

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
        $nflScores = json_decode($output);

        $games = array();
        foreach ($nflScores->gms as $score) {
            $now = date('Ymd');
            $gameDate = substr($score->eid,0,8);
            $doSomething = ($gameDate == $now) ? TRUE : FALSE;
            $gameDetails = $this->findFFPGameDetails($nflScores->w, $score->vnn, $score->hnn);
            if ($gameDetails) {
                array_push($games,(object) array(
                    'home_team' => $score->hnn,
                    'visitor_team' => $score->vnn,
                    'home_score' => $score->hs,
                    'visitor_score' => $score->vs,
                    'status' => $this->getGameInProgressDesc($score->q),
                    'game_id' => $gameDetails->id,
                    'day_of_week' => $gameDetails->day_of_week,
                    'game_datetime' => $gameDetails->game_datetime
                ));
                $dbResult = $this->insertOrUpdate($gameDetails, $score);
            }
        }

        // Record any wins
        $wins = $this->recordWins();

        return view('pages.update-scores')->with([
            'games' => $games,
            'week' => $nflScores->w,
            'wins' => $wins
            ]);
    }

    public function updateGameDetails2018() {
/*
{
    "2018090900":{
        "home":{
            "score":{"1":0,"2":0,"3":0,"4":0,"5":0,"T":0},
            "abbr":"BAL",
            "to":3},
        "away":{
            "score":{"1":0,"2":0,"3":0,"4":0,"5":0,"T":0},
            "abbr":"BUF",
            "to":3},
        "bp":0,
        "down":0,
        "togo":0,
        "clock":"15:00",
        "posteam":"BUF",
        "note":null,
        "redzone":false,
        "stadium":"M&T Bank Stadium",
        "media":{
            "radio":{"home":null,"away":null},
            "tv":"CBS",
            "sat":null,
            "sathd":null},
        "yl":"",
        "qtr":"Pregame"
    }        
}
*/
        date_default_timezone_set('America/New_York');
        $url = "http://www.nfl.com/liveupdate/scores/scores.json";

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
        $nflScores = json_decode($output);
        $games = array();
        foreach ($nflScores as $key=>$value) {
            // $key = date/game
            // $value = game details
            $now = date('Ymd');
            $gameDate = substr($key,0,8);
            $doSomething = ($gameDate == $now) ? TRUE : FALSE;
            $week = $this->getWeekFromGameDate($gameDate);
            $visitor = $this->getTeamName($value->away->abbr);
            $home = $this->getTeamName($value->home->abbr);
            $gameDetails = $this->findFFPGameDetails($week, $visitorScore, $homeScore);
dd($gameDetails);
            if ($gameDetails) {
                array_push($games,(object) array(
                    'home_team' => $score->hnn,
                    'visitor_team' => $score->vnn,
                    'home_score' => $score->hs,
                    'visitor_score' => $score->vs,
                    'status' => $this->getGameInProgressDesc($score->q),
                    'game_id' => $gameDetails->id,
                    'day_of_week' => $gameDetails->day_of_week,
                    'game_datetime' => $gameDetails->game_datetime
                ));
                $dbResult = $this->insertOrUpdate($gameDetails, $score);
            }
        }

    }        

    function getGameInProgressDesc($gameStatus) {
        $result = FALSE;
        switch ($gameStatus) {
            case "P":
                $result = "Pregame";
                break;
            case "F":
                $result = "Final";
                break;
            case "FO":
                $result = "Final OT";
                break;
            case "1":
                $result = "1st Qtr";
                break;
            case "2":
                $result = "2nd Qtr";
                break;
            case "3":
                $result = "3rd Qtr";
                break;
            case "4":
                $result = "4th Qtr";
                break;
            case "H":
                $result = "Halftime";
                break;
            default:
        }
        return $result;
    }

    function findFFPGameDetails($weekId, $visitor, $home) {
        $result = DB::table('games')
                ->where([
                    ['week_id','=',$weekId],
                    ['visitor_team','=',$visitor],
                    ['home_team','=',$home],
                ])
                ->select('id','day_of_week','game_datetime')
                ->get();
        if (count($result) == 0) { return FALSE; }
        return $result[0];
    }

    function getTeamName($abbr) {
        $result = DB::table('teams')
            ->where('team_name_short','=',$abbr)
            ->select('team_name')
            ->get();
        return $result[0];
    }

    function getWeekFromGameDate($gameDate) {
        $year = substr($gameDate,0,4);
        $month = substr($gameDate,4,2);
        $day = substr($gameDate,6,2);
        $gameDate = $year.'-'.$month.'-'.$day;
        $result = DB::table('games')
            ->whereBetween('game_datetime', [$gameDate.' 00:00:00', $gameDate.' 23:59:59'])
            ->select('week_id')
            ->first();
        return $result->week_id;
    }

    function insertOrUpdate($gameDetails, $game) {
        $result = DB::table('live_scores')
                ->where([
                    ['game_id','=',$gameDetails->id]
                ])
                ->select('id')
                ->get();
        date_default_timezone_set('America/New_York');
        $now = date('Y-m-d H:i:s');
        $winner = $this->determineWinner($game);

        if (count($result) == 0) {
            // Insert new row into database
            DB::table('live_scores')
                ->insert([
                    'game_id' => $gameDetails->id,
                    'visitor_team' => $game->vnn,
                    'home_team' => $game->hnn,
                    'visitor_score' => $game->vs,
                    'home_score' => $game->hs,
                    'game_status' => $this->getGameInProgressDesc($game->q),
                    'game_date' => $gameDetails->game_datetime,
                    'winner' => $winner,
                    'last_updated' => $now
                ]);
            return "insert";
        } else {
            // Update existing row in database
            DB::table('live_scores')
                ->where('game_id', $gameDetails->id)
                ->update([
                    'visitor_score' => $game->vs,
                    'home_score' => $game->hs,
                    'game_status' => $this->getGameInProgressDesc($game->q),
                    'winner' => $winner,
                    'last_updated' => $now
                ]);
            return "update";
        }
    }

    function determineWinner($game) {
        $gameStatus = $this->getGameInProgressDesc($game->q);
        if ($gameStatus == "Final" || $gameStatus == "Final OT") {
            // Game is over, declare a winner!
            if (intval($game->vs) > intval($game->hs)) {
                // Visiting team won
                return $game->vnn;
            } elseif (intval($game->vs) == intval($game->hs)) {
                // Game ended in tie (boo!)
                return "Tie";
            } else {
                // Home team won
                return $game->hnn;
            }
        } else {
            // Game is still in progess, return blank
            return "";
        }

    }

    function recordWins() {
/**
SELECT p.game_id, p.user_id, p.pick, s.winner, s.`game_status`
FROM picks p
INNER JOIN live_scores s ON (p.game_id = s.game_id)
WHERE p.user_id = 1 AND game_status IN ('Final','Final OT');
**/
        date_default_timezone_set('America/New_York');
        $now = date('Y-m-d H:i:s');

        $wins = DB::table('picks')
            ->join('live_scores','picks.game_id','=','live_scores.game_id')
            ->join('games','picks.game_id','=','games.id')
            ->select(DB::raw('picks.id, picks.game_id, picks.user_id, picks.pick, live_scores.winner, live_scores.game_status, live_scores.visitor_score, live_scores.home_score'))
            ->where('picks.reason','=',"")
            ->whereIn('live_scores.game_status',['Final','Final OT'])
            ->get();
        foreach ($wins as $win) {
            if ($win->winner == $win->pick) {
                $result = 1;
                $reason = "Good Pick";
            } elseif ($win->winner == "Tie") {
                $result = 1;
                $reason = "Tie";
            } else {
                $result = 0;
                $reason = "Bad Pick";
            }
            // Record wins/losses for games
            DB::table('games')
                ->where('id', $win->game_id)
                ->update([
                    'winner' => $win->winner,
                    'visitor_score' => $win->visitor_score,
                    'home_score' => $win->home_score,
                    'updated_at' => $now
                ]);

            // Record wins/losses for users
            DB::table('picks')
                ->where('id', $win->id)
                ->update([
                    'result' => $result,
                    'reason' => $reason,
                    'updated_at' => $now
                ]);
        }
    }
}
