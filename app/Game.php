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
				->select(DB::raw('picks.game_id, picks.user_id, users.nickname, users.display_name, users.avatar, picks.pick'))
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

	public function getCompletedGameCount() {
		$result = DB::table('games')
				->where('winner','!=',"")
				->get();
		return count($result);
	}
}
