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
		$today = date('Y-m-d', strtotime('2016-12-14'));
		$today = date('Y-m-d');
		$result = DB::table('games')
				->select(DB::raw('min(week_id) as week'))
				->where('game_datetime', '>=', $today)
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
}
