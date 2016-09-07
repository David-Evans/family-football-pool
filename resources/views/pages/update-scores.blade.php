<?php

	// [ ] DWE TODO: What day is it? Should I run or go back to sleep?

    $week = $games->w;
    $games = $games->gms;

    print '<h1>Live Scores for Week '.$week.'</h1>';
    foreach ($games as $game) {
    	// stdClass Object ( [hs] => 0 [d] => Thu [gsis] => 56866 [vs] => 17 [eid] => 2016081851 [h] => PIT [ga] => [rz] => -1 [v] => PHI [vnn] => Eagles [t] => 7:00 [q] => F [hnn] => Steelers )
    	// [X] DWE TODO: Find each game in the FFP `games` table (to get the unique record id)
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
		$gameDetails = findFFPGameDetails($week, $visitorTeam, $homeTeam);
?>
		<h3>Matchup: {{ $visitorTeam }} at {{ $homeTeam }}</h3>
		<blockquote>
			Game ID: {{ $gameDetails->id }}<br />
			Game Day: {{ $gameDetails->day_of_week }}<br />
			Game Time: {{ $gameDetails->game_datetime }}<br />
			Game Status: {{ $gameStatus }}<br />
			{{ $gameStatus }} score: {{ $visitorScore }} - {{ $homeScore }}<br />
		</blockquote>
		<hr />
<?php
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
?>