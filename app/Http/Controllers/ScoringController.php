<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\LiveScore;

use App\Game;

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
        //$this->middleware('auth');
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
        $url = env("NFL_URL",FALSE);

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
            $visitorScore = 0;
            $homeScore = 0;
            $down = $value->down;
            $togo = $value->togo;
            $yardline = $value->yl;
            $clock = $value->clock;
            $posteam = $home;
            $redzone = $value->redzone;
            $stadium = $value->stadium;
            if ($value->away->score->T !== NULL) { $visitorScore = $value->away->score->T; }
            if ($value->home->score->T !== NULL) { $homeScore = $value->home->score->T; }
            $status = $this->getGameInProgressDesc($value->qtr);
            $gameDetails = $this->findFFPGameDetails($week, $visitor, $home);
            if ($gameDetails) {
                array_push($games,(object) array(
                    'home_team' => $home,
                    'visitor_team' => $visitor,
                    'home_score' => $homeScore,
                    'visitor_score' => $visitorScore,
                    'status' => $status,
                    'game_id' => $gameDetails->id,
                    'day_of_week' => $gameDetails->day_of_week,
                    'game_datetime' => $gameDetails->game_datetime
                ));
                $score = (object) array(
                    'vnn'=>$visitor,
                    'hnn'=>$home,
                    'vs'=>$visitorScore,
                    'hs'=>$homeScore,
                    'status'=>$status,
                    'q'=>$value->qtr,
                    'down'=>$down,
                    'togo'=>$togo,
                    'yardline'=>$yardline,
                    'clock'=>$clock,
                    'posteam'=>$posteam,
                    'redzone'=>$redzone,
                    'stadium'=>$stadium
                    );
               $dbResult = $this->insertOrUpdate($gameDetails, $score);
            }
        }

        // Record any wins
        $wins = $this->recordWins();

        return view('pages.update-scores')->with([
            'games' => $games,
            'week' => $week,
            'wins' => $wins
            ]);
    }        

    function updateGameDetails2021(Request $request) {
/*
    {
        "GameKey": "202110133",
        "SeasonType": 1,
        "Season": 2021,
        "Week": 1,
        "Date": "2021-09-09T20:20:00",
        "AwayTeam": "DAL",
        "HomeTeam": "TB",
        "AwayScore": 34,
        "HomeScore": 36,
        "Quarter": "F",
        "TimeRemaining": null,
        "Possession": null,
        "Down": null,
        "Distance": "Scrambled",
        "YardLine": null,
        "YardLineTerritory": null,
        "RedZone": null,
        "HasStarted": true,
        "IsInProgress": false,
        "IsOver": true,
        "IsOvertime": false,
        "DownAndDistance": null,
        "QuarterDescription": "Final",
        "LastUpdated": "2021-09-13T17:37:07",
        "Canceled": false,
        "Closed": true,
        "Day": "2021-09-09T00:00:00",
        "DateTime": "2021-09-09T20:20:00",
        "Status": "Final",
        "GameEndDateTime": "2021-09-09T23:57:06",
        "HomeTimeouts": null,
        "AwayTimeouts": null,
        "StadiumDetails": {
            "StadiumID": 24,
            "Name": "Raymond James Stadium",
            "City": "Tampa Bay",
            "State": "FL",
            "Country": "USA",
            "Capacity": 65618,
            "PlayingSurface": "Grass",
            "GeoLat": 27.975833,
            "GeoLong": -82.503333,
            "Type": "Outdoor"
        }
    }
*/

        date_default_timezone_set('America/New_York');
        $date = ($request->input('date') == '') ? date('Y-m-d') : $request->input('date');
        $url = env("SPORTS_DATA_IO_URL",FALSE);
        $key = env("SPORTS_DATA_IO_KEY",FALSE);

        $url = $url.'/'.$date.'?key='.$key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $nflScores = json_decode($output);
        $games = array();

        foreach ($nflScores as $game=>$detail) {
            //$now = date('Y-m-d');
            $gameDate = substr($detail->Date,0,10);
            $doSomething = ($gameDate == $date) ? TRUE : FALSE;
            $week = $this->getWeekFromGameDate($gameDate);
            $visitor = $this->getTeamName($detail->AwayTeam);
            $home = $this->getTeamName($detail->HomeTeam);
            $visitorScore = 0;
            $homeScore = 0;
            $down = $detail->Down;
            $togo = null;
            $yardline = $detail->YardLine;
            $clock = $detail->TimeRemaining;
            $posteam = $detail->Possession;
            $redzone = $detail->RedZone;
            $stadium = $detail->StadiumDetails->Name;
            if ($detail->AwayScore !== NULL) { $visitorScore = $detail->AwayScore; }
            if ($detail->HomeScore !== NULL) { $homeScore = $detail->HomeScore; }
            $status = $this->getGameInProgressDesc($detail->Quarter);
            $gameDetails = $this->findFFPGameDetails($week, $visitor, $home);
            if ($gameDetails) {
                array_push($games,(object) array(
                    'home_team' => $home,
                    'visitor_team' => $visitor,
                    'home_score' => $homeScore,
                    'visitor_score' => $visitorScore,
                    'status' => $status,
                    'game_id' => $gameDetails->id,
                    'day_of_week' => $gameDetails->day_of_week,
                    'game_datetime' => $gameDetails->game_datetime
                ));
                $score = (object) array(
                    'vnn'=>$visitor,
                    'hnn'=>$home,
                    'vs'=>$visitorScore,
                    'hs'=>$homeScore,
                    'status'=>$status,
                    'q'=>$detail->Quarter,
                    'down'=>$down,
                    'togo'=>$togo,
                    'yardline'=>$yardline,
                    'clock'=>$clock,
                    'posteam'=>$posteam,
                    'redzone'=>$redzone,
                    'stadium'=>$stadium
                    );
                $dbResult = $this->insertOrUpdate($gameDetails, $score);
            }
        }
        dd($nflScores);
    }

    function updateGameDetails2021a(Request $request) {
/*
{
    "status": 200,
    "time": "2021-09-14T15:34:43.738Z",
    "games": 1,
    "skip": 0,
    "results": [
        {
            "schedule": {
                "date": "2021-09-14T00:15:00.000Z",
                "tbaTime": false
            },
            "summary": "Baltimore Ravens @ Las Vegas Raiders",
            "details": {
                "league": "NFL",
                "seasonType": "regular",
                "season": 2021,
                "conferenceGame": true,
                "divisionGame": false
            },
            "status": "final",
            "teams": {
                "away": {
                    "team": "Baltimore Ravens",
                    "location": "Baltimore",
                    "mascot": "Ravens",
                    "abbreviation": "BAL",
                    "conference": "AFC",
                    "division": "North"
                },
                "home": {
                    "team": "Las Vegas Raiders",
                    "location": "Las Vegas",
                    "mascot": "Raiders",
                    "abbreviation": "LV",
                    "conference": "AFC",
                    "division": "West"
                }
            },
            "lastUpdated": "2021-09-14T03:58:26.485Z",
            "gameId": 264301,
            "venue": {
                "name": "Allegiant Stadium",
                "city": "Las Vegas",
                "state": "NV",
                "neutralSite": false
            },
            "odds": [
                {
                    "spread": {
                        "open": {
                            "away": -4.5,
                            "home": 4.5,
                            "awayOdds": -115,
                            "homeOdds": -110
                        },
                        "current": {
                            "away": -3.5,
                            "home": 3.5,
                            "awayOdds": -105,
                            "homeOdds": -115
                        }
                    },
                    "moneyline": {
                        "open": {
                            "awayOdds": -215,
                            "homeOdds": 185
                        },
                        "current": {
                            "awayOdds": -173,
                            "homeOdds": 151
                        }
                    },
                    "total": {
                        "open": {
                            "total": 51,
                            "overOdds": -110,
                            "underOdds": -110
                        },
                        "current": {
                            "total": 50.5,
                            "overOdds": -110,
                            "underOdds": -110
                        }
                    },
                    "openDate": "2021-07-28T12:43:50.857Z",
                    "lastUpdated": "2021-09-14T00:13:25.465Z"
                }
            ],
            "scoreboard": {
                "score": {
                    "away": 27,
                    "home": 33,
                    "awayPeriods": [
                        7,
                        7,
                        3,
                        10,
                        0
                    ],
                    "homePeriods": [
                        0,
                        10,
                        0,
                        17,
                        6
                    ]
                },
                "currentPeriod": 5,
                "periodTimeRemaining": "0:00"
            }
        }
    ]
}
*/

        date_default_timezone_set('America/New_York');
        $date = ($request->input('date') == '') ? date('Y-m-d') : $request->input('date');
        $url = env("SPORTSPAGE_API_URL",FALSE);
        $key = env("SPORTSPAGE_API_KEY",FALSE);

        $url = $url.'&date='.$date;

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: sportspage-feeds.p.rapidapi.com",
                "x-rapidapi-key: ".$key
            ],
        ]); 
        $output = curl_exec($ch);
        curl_close($ch);
        $nflScores = json_decode($output);
        $games = array();

        foreach ($nflScores->results as $game=>$detail) {
            $week = $this->getWeekFromGameDate($date);
            $visitor = $this->getTeamName($detail->teams->away->abbreviation);
            $home = $this->getTeamName($detail->teams->home->abbreviation);
            $visitorScore = 0;
            $homeScore = 0;
            $qtr = null;
            $clock=null;
            $down = null;
            $togo = null;
            $yardline = null;
            $posteam = null;
            $redzone = null;
            $stadium = $detail->venue->name;

            if ($detail->status == 'in progress' || $detail->status == 'final') {
                $clock = $detail->scoreboard->periodTimeRemaining;
                if ($detail->scoreboard->score->away !== NULL) { $visitorScore = $detail->scoreboard->score->away; }
                if ($detail->scoreboard->score->home !== NULL) { $homeScore = $detail->scoreboard->score->home; }
                $status = $this->getGameInProgressDesc($detail->status);
                if ($detail->status == 'in progress') { $status = $this->getGameInProgressDesc($detail->scoreboard->currentPeriod); }
            }
            $gameDetails = $this->findFFPGameDetails($week, $visitor, $home);
            if ($gameDetails) {
                array_push($games,(object) array(
                    'home_team' => $home,
                    'visitor_team' => $visitor,
                    'home_score' => $homeScore,
                    'visitor_score' => $visitorScore,
                    'status' => $status,
                    'game_id' => $gameDetails->id,
                    'day_of_week' => $gameDetails->day_of_week,
                    'game_datetime' => $gameDetails->game_datetime
                ));
                $score = (object) array(
                    'vnn'=>$visitor,
                    'hnn'=>$home,
                    'vs'=>$visitorScore,
                    'hs'=>$homeScore,
                    'status'=>$status,
                    'q'=>$qtr,
                    'down'=>$down,
                    'togo'=>$togo,
                    'yardline'=>$yardline,
                    'clock'=>$clock,
                    'posteam'=>$posteam,
                    'redzone'=>$redzone,
                    'stadium'=>$stadium
                    );
                $dbResult = $this->insertOrUpdate($gameDetails, $score);
            }
        }
        dd($nflScores);
    }

    function getGameInProgressDesc($gameStatus) {
        $result = FALSE;
        switch ($gameStatus) {
            case "P":
                $result = "Pregame";
                break;
            case "Pregame":
            case "scheduled":
                $result = "Pregame";
                break;
            case "F":
                $result = "Final";
                break;
            case "final":
            case "Final":
                $result = "Final";
                break;
            case "FO":
            case "F/OT":
            case "final overtime":
                $result = "Final OT";
                break;  
            case "Overtime":
            case "OT":
                $result = "Overtime";
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
            case "Halftime":
                $result = "Halftime";
                break;
            case "Suspended":
            case "delayed":
            case "canceled":
                $result = "Suspended";
                break;
            default:
                $result = "Pregame";
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
            ->first();
        return $result->team_name;
    }

    function getWeekFromGameDate($gameDate) {
        try {
            $result = DB::table('games')
                ->whereBetween('game_datetime', [$gameDate.' 00:00:00', $gameDate.' 23:59:59'])
                ->select('week_id')
                ->first();
            if (count($result) == 0) { return FALSE; }
            return $result->week_id;
        } catch (Exception $e) {
            return FALSE;
        }
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
                    'down'=>$game->down,
                    'togo'=>$game->togo,
                    'yardline'=>$game->yardline,
                    'clock'=>$game->clock,
                    'pos_team'=>$game->posteam,
                    'redzone'=>$game->redzone,
                    'stadium'=>$game->stadium,
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
                    'down'=>$game->down,
                    'togo'=>$game->togo,
                    'yardline'=>$game->yardline,
                    'clock'=>$game->clock,
                    'pos_team'=>$game->posteam,
                    'redzone'=>$game->redzone,
                    'stadium'=>$game->stadium,
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

    public function liveScoreboard() {

        $game = new Game();
        $currDate = FALSE;
        $week = $game->getCurrentWeek();
$week = 1;
        // Get current live scores for current week
/*
SELECT live_scores.game_id, games.day_of_week, live_scores.visitor_team, live_scores.home_team, live_scores.visitor_score, live_scores.home_score, live_scores.game_status, live_scores.game_date, live_scores.winner, live_scores.down, live_scores.togo, live_scores.yardline, live_scores.clock, live_scores.pos_team, live_scores.redzone, live_scores.stadium, live_scores.last_updated
FROM live_scores S INNER JOIN games G ON (S.game_id = G.id)
*/
        $games = DB::table('live_scores')
            ->join('games','live_scores.game_id','=','games.id')
            ->join('teams AS TV','games.visitor_team','=','TV.team_name')
            ->join('teams AS TH','games.home_team','=','TH.team_name')
            ->select(DB::raw('live_scores.game_id, games.day_of_week, live_scores.visitor_team, TV.team_name_short AS visitor_team_short, live_scores.home_team, TH.team_name_short AS home_team_short, live_scores.visitor_score, live_scores.home_score, live_scores.game_status, live_scores.game_date, live_scores.winner, live_scores.down, live_scores.togo, live_scores.yardline, live_scores.clock, live_scores.pos_team, live_scores.redzone, live_scores.stadium, live_scores.last_updated'))
            ->where('games.week_id','=',$week)
            ->get();

        return view('pages.live-scoreboard')->with([
            'week' => $week,
            'games' => $games
            ]);

    }
}
