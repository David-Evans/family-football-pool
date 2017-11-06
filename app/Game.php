<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Game extends Model
{
	protected $fillable = [
		'week_id',
		'day_of_week',
		'game_datetime',
		'visitor_team',
		'home_team'
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];

	public function getCurrentWeek() {
		date_default_timezone_set('America/New_York');
		$rightNow = date("Y-m-d H:i:s");
		$sixHoursAgo = strtotime("-6 hours", strtotime($rightNow));
		$gameTime = date("Y-m-d H:i:s", $sixHoursAgo);

		$result = DB::table('games')
				->select(DB::raw('min(week_id) as week'))
				->where('game_datetime', '>=', $gameTime)
				->get();

		return $result[0]->week;
	}

	public function showPicks($week) {
		$result = DB::table('v$_games')
				->where('week_id','=',$week)
				->orderBy('game_datetime')
				->get();
		return $result;
	}

	public function showPicksReverse($week) {
		$result = DB::table('v$_games')
				->where('week_id','=',$week)
				->orderBy('game_datetime', 'DESC')
				->get();
		return $result;
	}

	public function getStandings() {
		$result = DB::table('picks')
				->join('users', 'picks.user_id', '=', 'users.id')
				->select(DB::raw('picks.user_id, users.nickname, users.display_name, users.avatar, sum(picks.result) as wins'))
				->groupBy('users.id')
				->orderBy('wins', 'desc')
				->get();
		return $result;
	}

	public function showAllPicks($week) {
		$result = DB::table('picks')
				->join('users', 'picks.user_id', '=', 'users.id')
				->join('games', 'picks.game_id', '=', 'games.id')
				->select(DB::raw('picks.game_id, picks.user_id, users.nickname, users.display_name, users.avatar, picks.pick, games.winner'))
				->where('games.week_id','=',$week)
				->orderBy('picks.user_id')
				->orderBy('game_id')
				->get();
		return $result;
	}

	public function getLeaders($week) {
		$result = DB::table('picks')
				->join('users', 'picks.user_id', '=', 'users.id')
				->join('games', 'picks.game_id', '=', 'games.id')
				->join('live_scores', 'picks.game_id', '=', 'live_scores.game_id')
				->select(DB::raw('picks.game_id, picks.user_id, users.nickname, users.display_name, users.avatar, picks.pick, games.winner'))
				->where('games.week_id','=',$week)
				->orderBy('picks.user_id')
				->orderBy('game_id')
				->get();
		return $result;
	}
	
	public function getGames($week) {
		$result = DB::table('games')
				->where('week_id','=',$week)
				->orderBy('id')
				->get();
		return $result;
	}

	public function getGamesInProgress($week) {
		$result = DB::table('live_scores')
				->join('games', 'live_scores.game_id','=','games.id')
				->select(DB::raw('live_scores.game_id,live_scores.visitor_team, live_scores.home_team, live_scores.visitor_score, live_scores.home_score, live_scores.game_status'))
				->where([
					['games.week_id','=',$week],
					['live_scores.games_status','!=','Final']])
				->orderBy('game_id')
				->get();
		return $result;
	}

	public function getMyPicks($week, $user) {
        $result = DB::table('picks')
            ->join('live_scores','picks.game_id','=','live_scores.game_id')
            ->join('games','picks.game_id','=','games.id')
            ->select(DB::raw('picks.id, picks.game_id, picks.user_id, picks.pick, games.visitor_team, games.home_team, games.day_of_week, games.game_datetime, live_scores.winner, live_scores.game_status, live_scores.visitor_score, live_scores.home_score'))
            ->where([
            	['games.week_id','=',$week],
            	['picks.user_id','=',$user->id]])
            ->orderBy('picks.game_id')
            ->get();
		return $result;
	}

	public function getMyPickIssues($week, $user) {
		$result = DB::select("SELECT id, visitor_team, home_team
			FROM `games` 
			WHERE id NOT IN (SELECT game_id FROM `picks` WHERE week_id = $week and user_id = $user->id)
			AND week_id = $week");
		return $result;
	}

	public function getMySummary($user) {
		$result = DB::select("SELECT G.week_id, user_id, nickname, display_name, SUM(result) wins, G2.games-SUM(result) losses, SUM(result)/G2.games pct, G2.games
			FROM `picks` P INNER JOIN `users` U ON (P.user_id = U.id) INNER JOIN `games` G ON (G.id = P.game_id)
			INNER JOIN (SELECT week_id, COUNT(id) games FROM `games` GROUP BY week_id) G2 ON (G.week_id = G2.week_id) 
			WHERE user_id = $user->id
			GROUP BY user_id, week_id
			ORDER BY week_id, user_id");
		return $result;
	}

	public function getCompletedGameCount() {
		$result = DB::table('games')
				->where('winner','!=',"")
				->get();
		return count($result);
	}
}
