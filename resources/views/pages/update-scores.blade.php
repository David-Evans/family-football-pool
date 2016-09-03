<?php

	// [ ] DWE TODO: What day is it? Should I run or go back to sleep?

	$url = 'http://www.nfl.com/liveupdate/scorestrip/ss.json';

    // create curl resource 
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url); 

    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 

    // close curl resource to free up system resources 
    curl_close($ch);      

    //$games = json_decode($output);
    $games = json_decode($output);
    $week = $games->w;
    $games = $games->gms;

    print '<h1>Live Scores for Week '.$week.'</h1>';
    foreach ($games as $game) {
    	// stdClass Object ( [hs] => 0 [d] => Thu [gsis] => 56866 [vs] => 17 [eid] => 2016081851 [h] => PIT [ga] => [rz] => -1 [v] => PHI [vnn] => Eagles [t] => 7:00 [q] => F [hnn] => Steelers )
    	// [ ] DWE TODO: Find each game in the FFP `games` table (to get the unique record id)
    	// [ ] DWE TODO: Insert or Update the `live_scores` table
    	// [ ] DWE TODO: Skip scores where a final action has taken place
    	// [ ] DWE TODO: If a winner is declared, update other tables (games, picks, teams)
    	$homeCity = $game->h;
    	$homeTeam = $game->hnn;
    	$homeScore = $game->hs;
    	$visitorCity = $game->v;
    	$visitorTeam = $game->vnn;
    	$visitorScore = $game->vs;
    	$gameDay = $game->d;
    	$gameDate = $game->eid;
    	$gameTime = $game->t;
    	$gameStatus = getGameInProgressDesc($game->q);
		// print_r($game).'<br />';
		//$gameId = findFFPGameID($week, 'Jets', 'Bills');
		$gameId = findFFPGameID($week, $visitorTeam, $homeTeam);
//dd($gameId);
?>
		<h3>Matchup: {{ $visitorTeam }} at {{ $homeTeam }}</h3>
		<p>Game ID: {{ $gameId }}</p>
		<p>Game Status: {{ $gameStatus }}</p>
		<p>Final score: {{ $visitorScore }} - {{ $homeScore }}</p>
		<hr />
<?php
    }
    // dd($output);


	$result = DB::table('users')
			->select('username','email')
			->get();


/**
<g eid="2015091000" gsis="56503" d="Thu" t="8:30" q="F" h="NE" hnn="patriots" hs="28" v="PIT" vnn="steelers" vs="21" rz="0" ga="" gt="REG"/>
	'eid : Game Date YYYYMMDD + NN (display order?)
	'gsis: Unique ID
	'd   : Day of week (Abbrev.)
	't   : Time of day (am/pm not incl.) Eastern Time
	'q   : Game status
		'P = Pregame
		'F = Final
		'FO = Final/OT
		'1 = 1st Qtr
		'2 = 2nd Qtr
		'3 = 3rd Qtr
		'4 = 4th Qtr
		'H = Halftime
	'h   : Home city
	'hnn : Home team
	'hs  : Home score
	'v   : Visitor city
	'vnn : Visitor team
	'vs' : Visitor score
	'rz  : Unknown
	'gt  : Season
		' PRE = Pre season
		' REG = Regular season
		' WC = Wild-card playoff game
		' DIV = Divisional Playoff game
		' CON = Conference Championship game
		' PRO = Probowl game
		' SB = Superbowl
**/

function findFFPGameID($weekId, $visitor, $home) {
	$result = DB::table('games')
			->where([
				['week_id','=',$weekId],
				['visitor_team','=',$visitor],
				['home_team','=',$home],
			])
			->select('id','day_of_week','game_datetime')
			->get();
	if (count($result) == 0) { return FALSE; }
	return $result[0]->id;
}

function isFinalScoreRecorded($gameId) {

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
			$result = "Final";
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
?>