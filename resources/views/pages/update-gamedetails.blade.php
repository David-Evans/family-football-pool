<?php

	// [ ] DWE TODO: What day is it? Should I run or go back to sleep?

    $week = $games->w;
    $games = $games->gms;

    print '<h1>Update Scores for Week '.$week.'</h1>';
    foreach ($games as $game) {
    	// stdClass Object ( [hs] => 0 [d] => Thu [gsis] => 56866 [vs] => 17 [eid] => 2016081851 [h] => PIT [ga] => [rz] => -1 [v] => PHI [vnn] => Eagles [t] => 7:00 [q] => F [hnn] => Steelers )
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

    	// [ ] DWE TODO: Is there a game today?
    	date_default_timezone_set('America/New_York');
    	$now = date('Ymd');
    	$gameDate = substr($gameDate,0,8);
    	$doSomething = ($gameDate == $now) ? TRUE : FALSE;
    	$gameStatus = getGameInProgressDesc($game->q);
		$gameDetails = findFFPGameDetails($week, $visitorTeam, $homeTeam);

    	if ($doSomething) {
			$dbResult = insertOrUpdate($gameDetails, $game);
    	}
?>
		<h3>Matchup: {{ $visitorTeam }} at {{ $homeTeam }}</h3>
		<blockquote>
			Game ID: {{ $gameDetails->id }}<br />
			Game Day: {{ $gameDetails->day_of_week }}<br />
			Game Time: {{ $gameDetails->game_datetime }}<br />
			Game Status: {{ $gameStatus }}<br />
			{{ $gameStatus }} score: {{ $visitorScore }} - {{ $homeScore }}<br />
			Compare Dates: Now={{ $now }}, GameDate={{ $gameDate }}<br />
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

function insertOrUpdate($gameDetails, $game) {
	$result = DB::table('live_scores')
			->where([
				['game_id','=',$gameDetails->id]
			])
			->select('id')
			->get();
	$gameStatus = getGameInProgressDesc($game->q);
	date_default_timezone_set('America/New_York');
	$now = date('Y-m-d H:i:s');
	$winner = determineWinner($game);

	if (count($result) == 0) {
		// Insert new row into database
		DB::table('live_scores')
			->insert([
				'game_id' => $gameDetails->id,
				'visitor_team' => $game->vnn,
				'home_team' => $game->hnn,
				'visitor_score' => $game->vs,
				'home_score' => $game->hs,
				'game_status' => $gameStatus,
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
				'game_status' => $gameStatus,
				'winner' => $winner,
				'last_updated' => $now
			]);
		return "update";
	}
}

function determineWinner($game) {
	$gameStatus = getGameInProgressDesc($game->q);
	if ($gameStatus == "Final" || $gameStatus == "Final OT") {
		// Game is over, declare a winner!
		if (intval($game->vs) > intval($game->hs)) {
			// Visiting team won
			return $game->vnn;
		} else {
			// Home team won
			return $game->hnn;
		}
	} else {
		// Game is still in progess, return blank
		return "";
	}
}
?>